@extends('layouts.app')

@section('title', 'Add Exam')

@push('style')
<link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
@endpush

@section('main')

<form action="{{route('exam.store')}}" method="POST">
    @csrf
    <div class="card">
        <div class="card-header">
            {{-- <h4>HTML5 Form Basic</h4> --}}
        </div>
        <div class="card-body">

            <div class="form-group">
                <label>Exam Name</label>
                <input required value="{{old("exam_name")}}" type="text" name="exam_name" class="form-control">
                @error("exam_name")
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Exam Year</label>
                <input required value="{{old("exam_year")}}" type="text" name="exam_year" class="form-control yearpicker">
                @error("exam_year")
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Exam Type</label>
                <select required  name="exam_type"  class="form-control">
                    <option value="">Select One</option>
                    <option @if (old("exam_type")=='1')
                        selected
                    @endif value="1">CT</option>
                    <option @if (old("exam_type")=='2')
                        selected
                    @endif value="2">Semester Final</option>
                </select>
                @error("exam_year")
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Department</label>
                <select required name="department" class="form-control department select2">
                    <option value="">Select One</option>
                    @foreach ($depts as $dept)
                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                    @endforeach
                </select>
                @error("department")
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Batch</label>
                <select required name="batch" class="form-control batch select2">
                    <option value="">Select One</option>
                </select>
                @error("batch")
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Year</label>
                <select required name="year" class="form-control">
                    <option value="">Select One</option>
                    <option>01</option>
                    <option>02</option>
                    <option>03</option>
                    <option>04</option>
                </select>
                @error("year")
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Semester</label>
                <select name="semester" class="form-control">
                    <option required value="">Select One</option>
                    <option>01</option>
                    <option>02</option>
                </select>
                @error("semester")
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <hr>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Exam Date</label>
                        <input required name="exam_date[0]" type="text" class="form-control datepicker">
                    </div>
                    @error("exam_date")
                    <div class="text-danger">{{$message}}</div>
                @enderror
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Exam Hall</label>
                        <select required name="hall[0]" class="form-control select2">
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
                        <select required name="course[0]" class="form-control course select2">
                            <option value="">Select One</option>
                        </select>
                        @error("course")
                    <div class="text-danger">{{$message}}</div>
                @enderror
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>Supervisor</label>
                        <select required name="supervisor[0]" class="form-control select2">
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
                        <select required name="teacher[0][]" multiple="" class="form-control teachers select2">
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                        @error("teacher")
                    <div class="text-danger">{{$message}}</div>
                @enderror
                    </div>
                </div>
                <div class="col-md-1">
                    <div style="margin-top: 2rem !important;">
                        <button id="removeId" class="btn btn-sm btn-danger">X</button>
                    </div>

                </div>
            </div>
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
        var course = "<option value=''>Select Any</option>";
        var count = 0;
        function add(){
            count++;
            // e.preventDefault();
            $(".extra").append(`<div class="row">
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
        }



            $(document).ready(function() {
                $(".select2").select2();
                $(".yearpicker").daterangepicker({locale: {format: 'YYYY'},singleDatePicker: true,autoApply: true,showDropdowns:true});

                $(document).on("click", "#removeId", function () {
                    $(this).closest(".row").remove();
                });

                $(".department").on('change', function(e) {
                    $(".batch").html('<option value="">Select One</option>');
                    $(".course").html('<option value="">Select One</option>');
                    var deptId = $(this).val();
                    if (deptId != "") {
                        var url = "/batch/bydept/" + deptId;
                        $.ajax({
                            url: url,
                            type: "GET",
                            success: function(result) {
                                $(".batch").html(result.data);
                            }
                        });

                        var url = "/subject/bydept/" + deptId;
                        $.ajax({
                            url: url,
                            type: "GET",
                            success: function(result) {
                                course = result.data;
                                $(".course").html(course);
                            }
                        });
                    }
                });

            });

    </script>
@endpush
