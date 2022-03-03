<?php

namespace App\Http\Controllers;

use App\Programme;
use App\Student;
use App\StudentProgramme;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentProgrammeController extends Controller
{
    use Filterable;
    protected $filter_model = StudentProgramme::class;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        if($request->is('api*')) {
            return JsonResource::collection($this->filter($request)->paginate());
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
     * @param  \App\StudentProgramme  $studentProgramme
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, StudentProgramme $studentProgramme)
    {
        if($request->is('api*')){
            return new JsonResource($studentProgramme);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StudentProgramme  $studentProgramme
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentProgramme $studentProgramme)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentProgramme  $studentProgramme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentProgramme $studentProgramme)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudentProgramme  $studentProgramme
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentProgramme $studentProgramme)
    {
        //
    }

    public function students_programmes(Request $request, Student $student){
        $records = $this->filter($request->all(), StudentProgramme::class, $student->students_programmes());
        if($request->is('api*')){
            return JsonResource::collection($records->paginate());
        }
    }
}
