@extends('layouts.app')

@section('title', 'Print Report')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
@endpush

@section('main')

<form action="{{route('exam.printreport')}}" method="POST">
    @csrf

    <div class="card">
        <div class="card-header">
            {{-- <h4>HTML5 Form Basic</h4> --}}
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-4">
                        <div class="form-group">
                            <label>From Date</label>
                            <input required name="from_date" type="text" class="form-control picker">
                        </div>
                        @error('from_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                        <div class="form-group">
                            <label>To Date</label>
                            <input required name="to_date"  type="text" class="form-control picker">
                        </div>
                        @error('to_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                        <div class="form-group">
                            <label>Type</label>
                            <select name="type" class="form-control">
                                <option value="">Select Type</option>
                                <option value="1">Invigilation</option>
                                <option value="2">Supervision</option>
                            </select>
                        </div>
                        @error('type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

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
    <!-- Page Specific JS File -->
    <script>
        $(document).ready(function() {
            $(".picker").daterangepicker({locale: {format: 'YYYY-MM-DD'},singleDatePicker: true,autoApply: true,showDropdowns:true});
        });
    </script>
@endpush
