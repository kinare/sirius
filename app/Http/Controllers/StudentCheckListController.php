<?php

namespace App\Http\Controllers;

use App\Student;
use App\StudentCheckList;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentCheckListController extends Controller
{
    use Filterable;
    protected $filter_model = StudentCheckList::class;
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
     * @param  \App\StudentCheckList  $studentCheckList
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, StudentCheckList $studentCheckList)
    {
        if($request->is('api*')){
            return new JsonResource($studentCheckList);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StudentCheckList  $studentCheckList
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentCheckList $studentCheckList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentCheckList  $studentCheckList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentCheckList $studentCheckList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudentCheckList  $studentCheckList
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentCheckList $studentCheckList)
    {
        //
    }

    public function students_check_lists(Request $request, Student $student){
        $records = $this->filter($request->all(), StudentCheckList::class, $student->students_check_lists());
        if($request->is('api*')){
            return JsonResource::collection($records->paginate());
        }
    }
}
