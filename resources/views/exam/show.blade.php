@extends('layouts.app')

@section('title', 'Update Exam')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
@endpush

@section('main')
    <div class="card">
        <div class="card-header">
            {{-- <h4>HTML5 Form Basic</h4> --}}
        </div>
        <div class="card-body">

            <div class="form-group">
                <label>Exam Name</label>
                <input required value="{{ $exam->name }}" type="text" readonly name="exam_name" class="form-control">

            </div>
            <div class="form-group">
                <label>Exam Year</label>
                <input readonly value="{{ $exam->exam_year }}" type="text" name="exam_year" class="form-control">

            </div>
            <div class="form-group">
                <label>Exam Type</label>
                <input readonly value="{{ $exam->type }}" type="text" name="exam_year" class="form-control">
            </div>

            <div class="form-group">
                <label>Year</label>
                <input readonly value="{{ $exam->year }}" type="text" name="exam_year" class="form-control">
            </div>

            <div class="form-group">
                <label>Semester</label>
                <input readonly value="{{ $exam->semester }}" type="text" name="exam_year" class="form-control">
            </div>
            <hr>
            @php
                $i = 1;
            @endphp
<div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>SL</th>
                    <th>Date</th>

                    <th>Hall</th>
                    <th>Course</th>
                    <th>Supervisor</th>
                    <th>Teacher</th>
                    <th>Action</th>
                </tr>

                @foreach ($exam->routines as $routine)
                    <tr>
                        <td>{{ $i++ }}</td>

                        <td>{{ $routine->exam_date }}</td>
                        <td>{{ $routine->exam_center->name }}</td>

                        <td>{{ $routine->subjects->pluck("course_code")->join(",") }}</td>

                        <td>{{ $routine->supervisors->pluck("name")->join(",")}}</td>
                        <td>{{ $routine->teachers->pluck("name")->join(",") }}</td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="{{ route("routine.edit",$routine->id) }}">
                                Edit
                            </a>
                            <form method="POST" action="{{ route("routine.destroy",$routine->id) }}">
                                @csrf
                                @method("DELETE")
                            <button type="submit" onclick="return confirm('Are you sure to delete?');" class="btn btn-sm btn-danger" href="">Delete</button>
                        </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

        </div>
    @endsection
