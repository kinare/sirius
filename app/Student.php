<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\LeaveType;

/**
 * @property mixed $check_lists
 * @property mixed $user
 * @property mixed $units
 * @property mixed $programmes
 * @property mixed $students_units
 * @property mixed $students_programmes
 */
class Student extends Model
{
    protected $table="students";
    public $incrementing =true;
    protected $primaryKey="id";
    public $timestamps = true;

    public  static function boot()
    {
        parent::boot();

        static::created(function ($student){
            Event::fire('student.created', $student);
        });
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->fillable = DB::getSchemaBuilder()->getColumnListing($this->getTable());
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function check_lists(){
        return $this->hasManyThrough(
                CheckList::class,
                StudentCheckList::class,
                'Student_ID',
                'Code',
                'No',
                'Questionnaire_Code'
            );
    }

    public function students_units(){
        return $this->hasMany(StudentUnit::class, 'Student_No', 'No');
    }

    public function programmes(){
        return $this->hasManyThrough(
            Programme::class,
            StudentProgramme::class,
            'Student_No',
            'Code',
            'No',
            'Programme'
        );
    }

    public function students_programmes(){
        return $this->hasMany(StudentProgramme::class, 'Student_No', 'No');
    }

    public function students_check_lists(){
        return $this->hasMany(StudentCheckList::class, 'Student_ID', 'No');
    }

    public function saveProfilePic($encodedImage){
        try{
            $decodedImage = base64_decode($encodedImage);
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $mimetype = $finfo->buffer($decodedImage);
            $mime_arr = explode('/', $mimetype );
            $extension = end($mime_arr);
            switch ($extension){
                case 'x-ms-bmp':
                    $extension = "bmp";
                    break;
            }
            $filename = "image.$extension";
            $path = "students/$this->No/profile_picture/$filename";

            if($extension != "x-empty"){
                Storage::disk('local')->put($path, $decodedImage);
                $this->Profile_Picture = $filename;
                $this->save();
            }
            else{
                $this->Profile_Picture = null;
                $this->save();
            }
            return true;
        }
        catch (\Exception $e){
            print($e);
            return false;
        }
    }
}
