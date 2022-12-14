<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Batch;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $batches = Batch::all();
        return view("batch.list", compact('batches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        return view("batch.add", compact('departments'));
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
            'department_id' => 'required',
            'session' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }



        $batches = new Batch();

        $batches->name = $request->name;
        $batches->department_id = $request->department_id;
        $batches->session = $request->session;
        $batches->save();

        $request->session()->flash('success', 'Batch added successfully!');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function show(Batch $batch)
    {
        return view('batch.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function edit(Batch $batch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'department_id' => 'required',
            'session' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }



        $batches = Batch::find($id);

        $batches->name = $request->name;
        $batches->department_id = $request->department_id;
        $batches->session = $request->session;
        $batches->save();

        return redirect()->route('batch.list')->with('success','Batch update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Batch $batch)
    {
        $batch->delete();
        return redirect()->back()->with("success","Deleted");
    }

    public function byDept(Request $request, $dept_id)
    {
        $batches = Batch::where("department_id", $dept_id)->orderBy("id", "desc")->get();

        $tem = "<option value=''>Select Any </option>";
        foreach ($batches as $batch) {
            $tem .= "<option value='" . $batch->id . "'>" . $batch->name . "</option>";
        }

        return response()->json([
            "data" => $tem,
            "success" => true
        ]);
    }
}
