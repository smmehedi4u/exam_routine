<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Department;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = Exam::all();
        return view('exam.list', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $depts = Department::orderBy("id", "desc")->get();
        // dd($batches);
        return view("exam.add", compact("depts"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'year' => 'required',
            'type' => 'required',
            'batch_id' => 'required',
            'semester' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }



        $exam = new Exam();

        $exam->name = $request->name;
        $exam->year = $request->year;
        $exam->type = $request->type;
        $exam->batch_id = $request->batch_id;
        $exam->semester = $request->semester;
        $exam->added_by = Auth::user()->id;
        $exam->save();

        $request->session()->flash('success', 'Exam added successfully!');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        return view('exam.show',compact('exam'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam,$id)
    {
        $exam = Exam::find($id);
        return view('exam.edit',compact('exam'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'year' => 'required',
            'type' => 'required',
            'batch_id' => 'required',
            'semester' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }



        $exam = Exam::find($id);

        $exam->name = $request->name;
        $exam->year = $request->year;
        $exam->type = $request->type;
        $exam->batch_id = $request->batch_id;
        $exam->semester = $request->semester;
        $exam->added_by = Auth::user()->id;
        $exam->save();

        return redirect()->route('exam.list')->with('success','Exam update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam, $id)
    {
        $exam = Exam::find($id);
        $exam->delete();
        return redirect()->route('exam.list')->with('success','Exam has been deleted successfully');
    }
}
