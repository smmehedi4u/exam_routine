<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::all();
        $subjects = Subject::all();
        return view("subject.list", compact('subjects','departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        return view("subject.add", compact('departments'));
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
            'course_name' => 'required',
            'course_code' => 'required',
            'year' => 'required',
            'semester' => 'required',
            'department_id' => 'required',

        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }



        $subjects = new Subject();

        $subjects->course_name = $request->course_name;
        $subjects->course_code = $request->course_code;
        $subjects->year = $request->year;
        $subjects->semester = $request->semester;
        $subjects->department_id = $request->department_id;
        $subjects->save();

        $request->session()->flash('success', 'Subject added successfully!');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        return view('subject.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $validator = Validator::make($request->all(), [
            'course_name' => 'required',
            'course_code' => 'required',
            'year' => 'required',
            'semester' => 'required',
            'department_id' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }



        $subjects = Subject::find($id);

        $subjects->course_name = $request->course_name;
        $subjects->course_code = $request->course_code;
        $subjects->year = $request->year;
        $subjects->semester = $request->semester;
        $subjects->department_id = $request->department_id;
        $subjects->save();

        return redirect()->route('subject.list')->with('success','Subject update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->back()->with("success","Deleted");
    }

    public function byDept(Request $request, $dept_id)
    {
        $courses = Subject::where("department_id", $dept_id)->get();
        // dd($courses);

        $tem = "<option value=''>Select Any </option>";
        foreach ($courses as $course) {
            $tem .= "<option value='" . $course->id . "'>" . $course->course_code . "-" . $course->course_name . "</option>";
        }

        return response()->json([
            "data" => $tem,
            "success" => true
        ]);
    }
}
