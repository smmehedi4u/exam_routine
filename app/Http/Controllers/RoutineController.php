<?php

namespace App\Http\Controllers;

use App\Models\ExamCenter;
use App\Models\Routine;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class RoutineController extends Controller
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     *
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Routine  $routine
     * @return \Illuminate\Http\Response
     */
    public function show(Routine $routine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Routine  $routine
     * @return \Illuminate\Http\Response
     */
    public function edit(Routine $routine)
    {
        $courses = Subject::orderBy("id", "desc")->get();
        $teachers = Teacher::orderBy("id", "desc")->get();
        $halls = ExamCenter::all();
        return view("routine.edit",compact("routine","teachers", "courses", "halls"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Routine  $routine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Routine $routine)
    {
        $validated = $request->validate([

            'exam_date' => 'required',
            'course' => 'required',
            'teacher' => 'required',
            'hall' => 'required',
            'supervisor' => 'required',
        ]);


$routine->update([
    'exam_date' => $request->exam_date,
    'exam_center_id' => $request->hall,
]);
        $routine->teachers()->sync($request->teacher);
        $routine->supervisors()->sync($request->supervisor);
        $routine->subjects()->sync($request->course);


        return redirect(route("exam.show",$routine->exam_id))->with("success","Updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Routine  $routine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Routine $routine)
    {
        $routine->delete();
        return back()->with("success","Delete successfully.");
    }
}
