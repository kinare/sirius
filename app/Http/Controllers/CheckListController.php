<?php

namespace App\Http\Controllers;

use App\CheckList;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CheckListController extends Controller
{
    use Filterable;
    protected $filter_model = CheckList::class;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CheckList  $checkList
     * @return \Illuminate\Http\Response
     */
    public function show(CheckList $checkList, Request $request)
    {
        if($request->is('api*')){
            return new JsonResource($checkList);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CheckList  $checkList
     * @return \Illuminate\Http\Response
     */
    public function edit(CheckList $checkList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CheckList  $checkList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CheckList $checkList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CheckList  $checkList
     * @return \Illuminate\Http\Response
     */
    public function destroy(CheckList $checkList)
    {
        //
    }

    public function students_check_lists(Request $request, Student $student){
        $records = $this->filter($request->all(), CheckList::class, $student->check_lists());
        if($request->is('api*')){
            return JsonResource::collection($records->paginate());
        }
    }
}
