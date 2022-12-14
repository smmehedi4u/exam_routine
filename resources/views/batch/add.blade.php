@extends('layouts.app')

@section('title', 'Add Batch')

@push('style')
<link rel="stylesheet"
href="{{ asset('library/select2/dist/css/select2.min.css') }}">
@endpush

@section('main')

<form action="{{route('batch.store')}}" method="POST">
    @csrf

    <div class="card">
        <div class="card-header">
            {{-- <h4>HTML5 Form Basic</h4> --}}
        </div>
        <div class="card-body">

            <div class="form-group">
                <label>Batch Name</label>
                 <input type="text" value="{{old('name')}}" name="name" class="form-control">

                @error('name')
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
            <div class="form-group">
                <label>Session</label>
                 <input type="session" value="{{old('session')}}" name="session" class="form-control">

                @error('session')
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
