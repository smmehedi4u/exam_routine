@extends('layouts.app')

@section('title', 'Add Subject')

@push('style')
<link rel="stylesheet"
href="{{ asset('library/select2/dist/css/select2.min.css') }}">
@endpush

@section('main')

<form action="{{route('subject.store')}}" method="POST">
    @csrf

    <div class="card">
        <div class="card-header">
            {{-- <h4>HTML5 Form Basic</h4> --}}
        </div>
        <div class="card-body">

            <div class="form-group">
                <label>Course Name</label>
                 <input type="text" value="{{old('course_name')}}" name="course_name" class="form-control">

                @error('course_name')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Course Code</label>
                <input type="text" value="{{old('course_code')}}" name="course_code" class="form-control">

                @error('course_code')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Year</label>
                 <input type="integer" value="{{old('year')}}" name="year" class="form-control">

                @error('year')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Semester</label>
                 <input type="integer" value="{{old('semester')}}" name="semester" class="form-control">

                @error('semester')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Department</label>
                <select name="department_id" class="form-control department select2">
                    <option value="">Select One</option>
                    @foreach ($departments as $dept)
                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                    @endforeach
                </select>

                @error('department_id')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">Submit</button>
            <button class="btn btn-secondary" type="reset">Reset</button>
        </div>
    </div>
</form>

@endsection
