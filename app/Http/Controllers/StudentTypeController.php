<?php

namespace App\Http\Controllers;

use App\StudentType;
use Illuminate\Http\Request;

class StudentTypeController extends Controller
{
    use Filterable;
    protected $filter_model = StudentType::class;
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
     * @param  \App\StudentType  $studentType
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, StudentType $studentType)
    {
        if($request->is('api*')){
            return new JsonResource($studentType);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StudentType  $studentType
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentType $studentType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentType  $studentType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentType $studentType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudentType  $studentType
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentType $studentType)
    {
        //
    }
}
