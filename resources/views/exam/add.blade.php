@extends('layouts.app')

@section('title', 'Add Exam')

@push('style')
<link rel="stylesheet"
href="{{ asset('library/select2/dist/css/select2.min.css') }}">
@endpush

@section('main')


    <div class="card">
        <div class="card-header">
            {{-- <h4>HTML5 Form Basic</h4> --}}
        </div>
        <div class="card-body">

            <div class="form-group">
                <label>Exam Name</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Exam Year</label>
                <input type="date" class="form-control">
            </div>
            <div class="form-group">
                <label>Exam Type</label>
                <select class="form-control">
                    <option value="">Select One</option>
                    <option value="1">CT</option>
                    <option value="2">Semester Final</option>
                </select>
            </div>
            <div class="form-group">
                <label>Department</label>
                <select class="form-control department select2">
                    <option value="">Select One</option>
                    @foreach ($depts as $dept)
                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Batch</label>
                <select class="form-control batch select2">
                    <option value="">Select One</option>
                </select>
            </div>

            <div class="form-group">
                <label>Semester</label>
                <select class="form-control">
                    <option value="">Select One</option>
                    <option>01</option>
                    <option>02</option>
                </select>
            </div>
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">Submit</button>
            <button class="btn btn-secondary" type="reset">Reset</button>
        </div>
    </div>

@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- Page Specific JS File -->
    <script>
            $(document).ready(function() {
                $(".select2").select2();

                $(".department").on('change', function(e) {
                    $(".batch").html('<option value="">Select One</option>');
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
                    }
                });

            });

    </script>
@endpush
