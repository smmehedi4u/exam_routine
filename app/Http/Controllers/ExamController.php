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
use Illuminate\Contracts\Database\Eloquent\Builder;
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

        $exams = Exam::orderBy("id", "desc")->get();
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
        // $depts = Department::orderBy("id", "desc")->get();
        $teachers = Teacher::orderBy("id", "desc")->get();
        $halls = ExamCenter::all();
        $subjects = Subject::all();
        // dd($batches);
        return view("exam.add", compact("teachers", "halls", "subjects"));
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
            // 'department' => 'required',
            // 'batch' => 'required',
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
                // 'batch_id' => $request->batch,
                'year' => $request->year,
                'semester' => $request->semester,
            ]);
            $exam_dates = $request->exam_date;
            $courses = $request->course;
            $teachers = $request->teacher;
            $halls = $request->hall;
            $supervisors = $request->supervisor;


            foreach ($exam_dates as $key => $val) {
                // dd($halls[$key]);
                $r = Routine::create([
                    'exam_id' => $exam->id,
                    'exam_date' => $val,
                    'exam_center_id' => $halls[$key],
                    'exam_time' => "10:00",
                ]);

                $r->teachers()->sync($teachers[$key]);
                $r->supervisors()->sync($supervisors[$key]);
                $r->subjects()->sync($courses[$key]);

                // foreach ($teachers[$key] as $value) {
                //     ExamDuty::create([
                //         'teacher_id' => $value,
                //         'routine_id' => $r->id
                //     ]);
                // }
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
        $exam = $exam->load("routines","routines.exam_center","routines.teachers","routines.supervisors","routines.subjects");

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


        // $depts = Department::orderBy("id", "desc")->get();
        // $batches = Batch::orderBy("id", "desc")->get();
        $courses = Subject::orderBy("id", "desc")->get();
        $teachers = Teacher::orderBy("id", "desc")->get();
        $halls = ExamCenter::all();
        // foreach ($exam->routines as $routine) {
        //     dd($routine->exam_duties->pluck('teacher_id'));
        // }
        // dd($courses->toArray());
        $exam = Exam::with([
        "routines"=>fn($q)=>$q->orderBy("exam_date"),
        "routines.teachers",
        "routines.supervisors",
        "routines.subjects"])->whereId($exam->id)->first();

        // dd($exam);
        return view("exam.edit", compact("exam", "teachers", "courses", "halls"));

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
            // 'department' => 'required',
            // 'batch' => 'required',
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
                // 'batch_id' => $request->batch,
                'year' => $request->year,
                'semester' => $request->semester,
            ]);
            $routine_id = $request->routine_id;
            $exam_dates = $request->exam_date;
            $courses = $request->course;
            $teachers = $request->teacher;

            $halls = $request->hall;
            $supervisors = $request->supervisor;

            foreach ($exam_dates as $key => $val) {
                if ($routine_id[$key] == null) {
                    $r = Routine::create(['exam_id' => $exam->id,
                        'exam_date' => $val,
                        'exam_center_id' => $halls[$key],
                        'exam_time' => "10:00",
                    ]);

                    $r->teachers()->sync($teachers[$key]);
                    $r->supervisors()->sync($supervisors[$key]);
                    $r->subjects()->sync($courses[$key]);

                } else {
                    Routine::where("id", $routine_id[$key])->update([
                        // 'subject_id' => $courses[$key],
                        'exam_date' => $val,
                        'exam_center_id' => $halls[$key],
                        // 'teacher_id' => $supervisor[$key],
                        'exam_time' => "10:00",
                    ]);
                    $r = Routine::where("id", $routine_id[$key])->first();
                    // dd($r);


                    $r->teachers()->sync($teachers[$key]);
                    $r->supervisors()->sync($supervisors[$key]);
                    $r->subjects()->sync($courses[$key]);

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
            "routines" => Routine::with("supervisors:id,name", "exam_center:id,name", "subjects:id,course_name,course_code", "teachers:id,name")
                ->withCount("exam_duties")
                ->where("exam_id", $exam->id)
                ->orderBy("exam_date")
                ->get(),
        ];

        // dd($data['routines']->toArray());
        $pdf = PDF::loadView('exam.print', $data);
        return $pdf->stream('document.pdf');
        // return view("exam.print", $data);

        // return view("exam.print", compact("exam"));

    }

    public function report(Request $request)
    {

        return view("exam.report");
    }

    public function printreport(Request $request)
    {
        $validated = $request->validate([
            'from_date' => 'required',
            'to_date' => 'required',
            'type' => 'required',
        ]);

        $from = $request->from_date;
        $to = $request->to_date;
        $type = $request->type;

        $depts = Department::with(["teachers"])->get();
        $data = [
            "depts" => $depts,
            "type" => $type,
            "from" => $from,
            "to" => $to
        ];



        $pdf = PDF::loadView('exam.printreport', $data);
        return $pdf->stream('document.pdf');
    }
}
