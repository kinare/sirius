<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property mixed $student
 * @property mixed $programme
 * @property mixed $semester
 * @property mixed $programme_unit
 */
class StudentUnit extends Model
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
        return $this->belongsTo(Programme::class, 'Programme', "Code");
    }

    public function semester(){
        return $this->belongsTo(Semester::class, 'Semester', "Code");
    }

    public function programme_unit(){
        return $this->belongsTo(ProgrammeUnit::class, 'Unit', "Code");
    }
}
