@extends('layouts.app')

@section('title', 'Update Exam')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
@endpush

@section('main')

    <form action="{{ route('routine.update', $routine) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">
                {{-- <h4>HTML5 Form Basic</h4> --}}
            </div>
            <div class="card-body">


                    <div class="row">

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Exam Date</label>
                                <input required value="{{ $routine->exam_date }}" name="exam_date"
                                    type="text" class="form-control datepicker">
                            </div>
                            @error('exam_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Exam Hall</label>
                                <select required name="hall" class="form-control select2">
                                    @foreach ($halls as $hall)
                                        <option @if ($routine->exam_center_id == $hall->id) selected @endif
                                            value="{{ $hall->id }}">{{ $hall->name }}</option>
                                    @endforeach
                                </select>
                                @error('hall')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Course</label>
                                <select required name="course[]" multiple=""
                                    class="form-control course select2">
                                    @foreach ($courses as $course)
                                        <option @if (in_array(
                                            $course->id,
                                            $routine->subjects()->pluck('subject_id')->toArray())) selected @endif
                                            value="{{ $course->id }}">
                                            {{ $course->course_code }}-{{ $course->course_name }}</option>
                                    @endforeach
                                </select>
                                @error('course')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Sepervisor</label>
                                <select required name="supervisor[]" multiple=""
                                    class="form-control select2">
                                    @foreach ($teachers as $teacher)
                                        <option @if (in_array(
                                            $teacher->id,
                                            $routine->supervisors()->pluck('teacher_id')->toArray())) selected @endif
                                            value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                                @error('supervisor')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Teacher</label>
                                <select required name="teacher[]" multiple=""
                                    class="form-control teachers select2">
                                    @foreach ($teachers as $teacher)
                                        <option @if (in_array(
                                            $teacher->id,
                                            $routine->teachers()->pluck('teacher_id')->toArray())) selected @endif
                                            value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                                @error('teacher')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary mr-1" type="submit">Submit</button>
                <button class="btn btn-secondary" type="reset">Reset</button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')


<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>

<script>
        $(document).ready(function() {
            $(".select2").select2();
        });
    </script>
@endpush
