<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentUnitResource;
use App\Student;
use App\StudentUnit;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentUnitController extends Controller
{
    use Filterable;
    protected $filter_model = StudentUnit::class;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        if($request->is('api*')) {
            return StudentUnitResource::collection($this->filter($request)->paginate());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //StudentCheckList $studentCheckList
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StudentUnit  $studentUnit
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, StudentUnit $studentUnit)
    {
        if($request->is('api*')){
            return new StudentUnitResource($studentUnit);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StudentUnit  $studentUnit
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentUnit $studentUnit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentUnit  $studentUnit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentUnit $studentUnit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudentUnit  $studentUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentUnit $studentUnit)
    {
        //
    }

    public function students_units(Request $request, Student $student){
        $records = $this->filter($request->all(), StudentUnit::class, $student->students_units());
        if($request->is('api*')){
            return StudentUnitResource::collection($records->paginate());
        }
    }
}
