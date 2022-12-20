<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExamCenterRequest;
use App\Http\Requests\UpdateExamCenterRequest;
use App\Models\ExamCenter;
use Illuminate\Support\Facades\Validator;

class ExamCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $examCenters = ExamCenter::all();
        return view("examCenter.list", compact('examCenters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("examCenter.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExamCenterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExamCenterRequest $request)
    {

        ExamCenter::create($request->all());

        $request->session()->flash('success', 'Exam center added successfully!');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExamCenter  $examCenter
     * @return \Illuminate\Http\Response
     */
    public function show(ExamCenter $examCenter)
    {
        return view('examCenter.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExamCenter  $examCenter
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamCenter $examCenter)
    {

        return view('examCenter.edit',compact('examCenter'));
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
        $examCenter->update($request->all());

        return redirect()->route('exam_center.index')->with('success','Exam Center update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExamCenter  $examCenter
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamCenter $examCenter)
    {
        $examCenter->delete();
        return redirect()->back()->with("success","Deleted");
    }
}
