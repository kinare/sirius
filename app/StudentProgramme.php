<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property mixed $student
 * @property mixed $programme
 */
class StudentProgramme extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->fillable = DB::getSchemaBuilder()->getColumnListing($this->getTable());
    }

    public function student(){
        return $this->belongsTo(Student::class, 'Student_No', "No");
    }

    public function programme(){
        return $this->belongsTo(Student::class, 'Programme', "Code");
    }
}
