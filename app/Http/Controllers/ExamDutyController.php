<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExamDutyRequest;
use App\Http\Requests\UpdateExamDutyRequest;
use App\Models\ExamDuty;

class ExamDutyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreExamDutyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExamDutyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExamDuty  $examDuty
     * @return \Illuminate\Http\Response
     */
    public function show(ExamDuty $examDuty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExamDuty  $examDuty
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamDuty $examDuty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExamDutyRequest  $request
     * @param  \App\Models\ExamDuty  $examDuty
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExamDutyRequest $request, ExamDuty $examDuty)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExamDuty  $examDuty
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamDuty $examDuty)
    {
        //
    }
}
