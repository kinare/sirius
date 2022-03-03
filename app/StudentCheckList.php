<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property mixed $student
 */
class StudentCheckList extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->fillable = DB::getSchemaBuilder()->getColumnListing($this->getTable());
    }

    public function student(){
        return $this->belongsTo(Student::class, 'Student_ID', "No");
    }
}
