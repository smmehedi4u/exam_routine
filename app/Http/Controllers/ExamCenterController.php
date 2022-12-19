<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExamCenterRequest;
use App\Http\Requests\UpdateExamCenterRequest;
use App\Models\ExamCenter;

class ExamCenterController extends Controller
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
     * @param  \App\Http\Requests\StoreExamCenterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExamCenterRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExamCenter  $examCenter
     * @return \Illuminate\Http\Response
     */
    public function show(ExamCenter $examCenter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExamCenter  $examCenter
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamCenter $examCenter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExamCenterRequest  $request
     * @param  \App\Models\ExamCenter  $examCenter
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExamCenterRequest $request, ExamCenter $examCenter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExamCenter  $examCenter
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamCenter $examCenter)
    {
        //
    }
}
