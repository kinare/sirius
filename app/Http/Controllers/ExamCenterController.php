<?php

namespace App\Http\Controllers;

use App\ExamCenter;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExamCenterController extends Controller
{
    use Filterable;
    protected $filter_model = ExamCenter::class;
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
     * @param  \App\ExamCenter  $examCenter
     * @return \Illuminate\Http\Response
     */
    public function show( Request $request, ExamCenter $examCenter)
    {
        if($request->is('api*')){
            return new JsonResource($examCenter);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExamCenter  $examCenter
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamCenter $examCenter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExamCenter  $examCenter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExamCenter $examCenter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExamCenter  $examCenter
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamCenter $examCenter)
    {
        //
    }
}
