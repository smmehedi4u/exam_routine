<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Department;
use App\Models\Exam;
use App\Models\ExamCenter;
use App\Models\ExamDuty;
use App\Models\Routine;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $exams = Exam::with("batch:id,name")->orderBy("id", "desc")->get();
        // dd($exams->toArray());
        return view("exam.list", compact("exams"));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $depts = Department::orderBy("id", "desc")->get();
        $teachers = Teacher::orderBy("id", "desc")->get();
        $halls = ExamCenter::all();
        // dd($batches);
        return view("exam.add", compact("depts", "teachers", "halls"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'exam_name' => 'required',
            'exam_year' => 'required',
            'exam_type' => 'required',
            'department' => 'required',
            'batch' => 'required',
            'year' => 'required',
            'semester' => 'required',
            'exam_date.*' => 'required',
            'course.*' => 'required',
            'hall.*' => 'required',
            'supervisor.*' => 'required',
            'teacher.*' => 'required',
        ]);
        // dd($request->all());
        DB::beginTransaction();

        try {

            $exam = Exam::create([
                'name' => $request->exam_name,
                'exam_year' => $request->exam_year,
                'type' => $request->exam_type,
                'batch_id' => $request->batch,
                'year' => $request->year,
                'semester' => $request->semester,
            ]);
            $exam_dates = $request->exam_date;
            $courses = $request->course;
            $teachers = $request->teacher;
            $halls = $request->hall;
            $supervisor = $request->supervisor;


            foreach ($exam_dates as $key => $val) {
                // dd($halls[$key]);
                $r = Routine::create([
                    'exam_id' => $exam->id,
                    'subject_id' => $courses[$key],
                    'exam_date' => $val,
                    'exam_center_id' => $halls[$key],
                    'teacher_id' => $supervisor[$key],
                    'exam_time' => "10:00",
                ]);

                foreach ($teachers[$key] as $value) {
                    ExamDuty::create([
                        'teacher_id' => $value,
                        'routine_id' => $r->id
                    ]);
                }
            }
            DB::commit();
            return redirect()->back()->with("success", "Added successfully. Navigate To list page for print.");
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with("error", "Something going wrong." . $e);
        }

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
    public function edit(Exam $exam)
    {


        $depts = Department::orderBy("id", "desc")->get();
        $batches = Batch::where("department_id", $exam->batch->department_id)->orderBy("id", "desc")->get();
        $courses = Subject::where("department_id", $exam->batch->department_id)->orderBy("id", "desc")->get();
        $teachers = Teacher::orderBy("id", "desc")->get();
        $halls = ExamCenter::all();
        // foreach ($exam->routines as $routine) {
        //     dd($routine->exam_duties->pluck('teacher_id'));
        // }
        // dd($courses->toArray());

        return view("exam.edit", compact("exam", "depts", "teachers", "batches", "courses", "halls"));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {

        $validated = $request->validate([
            'exam_name' => 'required',
            'exam_year' => 'required',
            'exam_type' => 'required',
            'department' => 'required',
            'batch' => 'required',
            'year' => 'required',
            'semester' => 'required',
            'exam_date.*' => 'required',
            'course.*' => 'required',
            'teacher.*' => 'required',
            'hall.*' => 'required',
            'supervisor.*' => 'required',
        ]);
        // dd($request->all());
        DB::beginTransaction();

        try {

            $exam->update([
                'name' => $request->exam_name,
                'exam_year' => $request->exam_year,
                'type' => $request->exam_type,
                'batch_id' => $request->batch,
                'year' => $request->year,
                'semester' => $request->semester,
            ]);
            $routine_id = $request->routine_id;
            $exam_dates = $request->exam_date;
            $courses = $request->course;
            $teachers = $request->teacher;

            $halls = $request->hall;
            $supervisor = $request->supervisor;

            foreach ($exam_dates as $key => $val) {
                if ($routine_id[$key] == null) {
                    $r = Routine::create([
                        'exam_id' => $exam->id,
                        'subject_id' => $courses[$key],
                        'exam_date' => $val,

                        'exam_center_id' => $halls[$key],
                        'teacher_id' => $supervisor[$key],
                        'exam_time' => "10:00",
                    ]);

                    foreach ($teachers[$key] as $value) {
                        ExamDuty::create([
                            'teacher_id' => $value,
                            'routine_id' => $r->id
                        ]);
                    }
                } else {
                    Routine::where("id", $routine_id[$key])->update([
                        'subject_id' => $courses[$key],
                        'exam_date' => $val,
                        'exam_center_id' => $halls[$key],
                        'teacher_id' => $supervisor[$key],
                        'exam_time' => "10:00",
                    ]);
                    $r = Routine::where("id", $routine_id[$key])->first();
                    // dd($r);


                    ExamDuty::where("routine_id", $r->id)->delete();

                    foreach ($teachers[$key] as $value) {
                        ExamDuty::create([
                            'teacher_id' => $value,
                            'routine_id' => $r->id
                        ]);
                    }
                }
            }
            DB::commit();
            return redirect()->back()->with("success", "Updated successfully. Navigate To list page for print.");
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with("error", "Something going wrong." . $e);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();
        return redirect()->back()->with("success", "Deleted Successfully.");
    }

    public function print(Exam $exam)
    {
        $data = [
            "exam" => $exam,
            "routines" => Routine::with("teacher:id,name", "exam_center:id,name", "subject:id,course_name,course_code", "exam_duties.teacher:id,name")
                ->withCount("exam_duties")
                ->where("exam_id", $exam->id)
                ->get(),
        ];
        // dd($data['routines']);
        $pdf = PDF::loadView('exam.print', $data);
        return $pdf->stream('document.pdf');
        // return view("exam.print", compact("exam"));

    }
}
