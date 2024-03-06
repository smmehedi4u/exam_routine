@extends('layouts.app')

@section('title', 'Update Exam')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
@endpush

@section('main')

    <form action="{{ route('exam.update', $exam->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">
                {{-- <h4>HTML5 Form Basic</h4> --}}
            </div>
            <div class="card-body">

                <div class="form-group">
                    <label>Exam Name</label>
                    <input required value="{{ $exam->name }}" type="text" name="exam_name" class="form-control">
                    @error('exam_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Exam Year</label>
                    <input required value="{{ $exam->exam_year }}" type="text" name="exam_year"
                        class="form-control yearpicker">
                    @error('exam_year')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Exam Type</label>
                    <select required name="exam_type" class="form-control">
                        <option @if ($exam->type == 'CT') selected @endif value="1">CT</option>
                        <option @if ($exam->type == "Semester Final") selected @endif value="2">Semester Final</option>
                    </select>
                    @error('type')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                {{-- <div class="form-group">
                <label>Department</label>
                <select required name="department" class="form-control department select2">

                    @foreach ($depts as $dept)
                        <option @if ($exam->batch->department_id == $dept->id)
                            selected
                        @endif  value="{{ $dept->id }}">{{ $dept->name }}</option>
                    @endforeach
                </select>
                @error('department')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div> --}}
                {{-- <div class="form-group">
                <label>Batch</label>
                <select required name="batch" class="form-control batch select2">
                    @foreach ($batches as $batch)
                        <option @if ($exam->batch_id == $batch->id)
                            selected
                        @endif  value="{{ $batch->id }}">{{ $batch->name }}</option>
                    @endforeach
                </select>
                @error('batch')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div> --}}
                <div class="form-group">
                    <label>Year</label>

                    <select required name="year" class="form-control">
                        @for ($i = 1; $i < 5; $i++)
                            <option @if ($exam->year == $i) selected @endif value="{{ $i }}">
                                {{ $i }}</option>
                        @endfor
                    </select>
                    @error('year')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Semester</label>
                    <select name="semester" class="form-control">
                        <option @if ($exam->semester == '1') selected @endif value="1">1</option>
                        <option @if ($exam->semester == '2') selected @endif value="2">2</option>
                    </select>
                    @error('semester')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <hr>
                @php
                    $i = 0;
                @endphp
                @foreach ($exam->routines as $routine)
                    <div class="row">
                        <input type="hidden" name="routine_id[{{ $i }}]" value="{{ $routine->id }}">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Exam Date</label>
                                <input required value="{{ $routine->exam_date }}" name="exam_date[{{ $i }}]"
                                    type="text" class="form-control datepicker">
                            </div>
                            @error('exam_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Exam Hall</label>
                                <select required name="hall[{{ $i }}]" class="form-control select2">
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
                                <select required name="course[{{ $i }}][]" multiple=""
                                    class="form-control course select2">
                                    @foreach ($courses as $course)
                                        <option @if (in_array(
                                            $course->id,
                                            $routine->subjects->pluck('id')->toArray())) selected @endif
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
                                <select required name="supervisor[{{ $i }}][]" multiple=""
                                    class="form-control select2">
                                    @foreach ($teachers as $teacher)
                                        <option @if (in_array(
                                            $teacher->id,
                                            $routine->supervisors->pluck('id')->toArray())) selected @endif
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
                                <select required name="teacher[{{ $i }}][]" multiple=""
                                    class="form-control teachers select2">
                                    @foreach ($teachers as $teacher)
                                        <option @if (in_array(
                                            $teacher->id,
                                            $routine->teachers->pluck('id')->toArray())) selected @endif
                                            value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                                @error('teacher')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    @php
                        $i++;
                    @endphp
                @endforeach
                <div class="extra"></div>
                <div class="row">
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-5">

                    </div>
                    <div class="col-md-1">
                        <div style="margin-top: 2rem !important;">
                            <button type="button" onclick="add()" class="btn btn-block btn-success">+</button>
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
    <!-- JS Libraies -->
    <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- Page Specific JS File -->
    <script>
        var courseS = {!! json_encode($courses->toArray()) !!};
        var course = "<option value=''>Select one </option>";
        var count = {{ $i }};

        function addC() {
            var c = "";
            courseS.forEach(element => {
                c += "<option value='" + element.id + "'>" + element.course_code + "-" + element.course_name +
                    "</option>";
            });
            course = c;
        }
        addC();

        function add(){

// e.preventDefault();
$(".extra").append(`<div class="row">
    <input type="hidden" name="routine_id[`+count+`]">
    <div class="col-md-2">
        <div class="form-group">
            <label>Exam Date</label>
            <input required name="exam_date[`+count+`]" type="text" class="form-control datepicker">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Exam Hall</label>
            <select required name="hall[`+count+`]" class="form-control select2">
                @foreach ($halls as $hall)
                    <option value="{{ $hall->id }}">{{ $hall->name }}</option>
                @endforeach
            </select>
            @error("hall")
        <div class="text-danger">{{$message}}</div>
    @enderror
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Course</label>
            <select required name="course[`+count+`]" class="form-control course select2">`+course+`</select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Supervisor</label>
            <select required name="supervisor[`+count+`]" class="form-control select2">
                @foreach ($teachers as $teacher)
                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
            @endforeach
            </select>
            @error("supervisor")
        <div class="text-danger">{{$message}}</div>
    @enderror
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Teacher</label>
            <select required name="teacher[`+count+`][]" multiple="" class="form-control teacher select2">

                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-1">
        <div style="margin-top: 2rem !important;">
            <button id="removeId" class="btn btn-sm btn-danger">X</button>
        </div>

    </div>
</div>`);
$(".extra .row .datepicker").last().daterangepicker({locale: {format: 'YYYY-MM-DD'},singleDatePicker: true,autoApply: true,});
$(".extra .row").last().find(".select2").select2();
count++;
}




        $(document).ready(function() {
            $(".select2").select2();
            $(".yearpicker").daterangepicker({
                locale: {
                    format: 'YYYY'
                },
                singleDatePicker: true,
                autoApply: true,
                showDropdowns: true
            });

            $(document).on("click", "#removeId", function() {
                $(this).closest(".row").remove();
            });

            // $(".department").on('change', function(e) {
            //     $(".batch").html('<option value="">Select One</option>');
            //     $(".course").html('<option value="">Select One</option>');
            //     var deptId = $(this).val();
            //     if (deptId != "") {
            //         var url = "/batch/bydept/" + deptId;
            //         $.ajax({
            //             url: url,
            //             type: "GET",
            //             success: function(result) {
            //                 $(".batch").html(result.data);
            //             }
            //         });

            //         var url = "/subject/bydept/" + deptId;
            //         $.ajax({
            //             url: url,
            //             type: "GET",
            //             success: function(result) {
            //                 course = result.data;
            //                 $(".course").html(course);
            //             }
            //         });
            //     }
            // });

        });
    </script>
@endpush
