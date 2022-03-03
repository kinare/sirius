<?php

namespace App\Http\Controllers;

use App\ProgrammeUnit;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgrammeUnitController extends Controller
{
    use Filterable;
    protected $filter_model = ProgrammeUnit::class;
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
     * @param  \App\ProgrammeUnit  $programmeUnit
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ProgrammeUnit $programmeUnit)
    {
        if($request->is('api*')){
            return new JsonResource($programmeUnit);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProgrammeUnit  $programmeUnit
     * @return \Illuminate\Http\Response
     */
    public function edit(ProgrammeUnit $programmeUnit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProgrammeUnit  $programmeUnit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProgrammeUnit $programmeUnit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProgrammeUnit  $programmeUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProgrammeUnit $programmeUnit)
    {
        //
    }
}
