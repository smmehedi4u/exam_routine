@extends('layouts.app')

@section('title', 'Subject List')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/datatables/media/css/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/datatables/media/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/datatables/media/css/select.bootstrap4.min.css') }}">

    <link rel="stylesheet"
        href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
@endpush

@section('main')


    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table-striped table"
                    id="table-1">
                    <thead>
                        <tr>
                            <th class="text-center">
                                #
                            </th>
                            <th>Course Name</th>
                            <th>Course Code</th>
                            <th>Year</th>
                            <th>Semester</th>
                            <th>Department</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subjects as $subject)
                        <tr>
                            <td>

                            </td>
                            <td>
                                {{ $subject->course_name }}
                            </td>
                            <td>
                                {{ $subject->course_code }}
                            </td>
                            <td>
                                {{ $subject->year }}
                            </td>
                            <td>
                                {{ $subject->semester }}
                            </td>
                            <td>
                                {{ $subject->department->name }}
                            </td>
                            <td>
                                <form action="{{ route('subject.destroy',$subject->id) }}" method="Post">

                                    {{-- <a href="{{ route('department.edit',$department->id) }}" class="btn btn-success">Edit</a> --}}
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>

                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <!-- JS Libraies -->
    {{-- <script src="assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script> --}}
    <script src="{{ asset('library/datatables/media/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('library/datatables/media/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    {{-- <script src="{{ asset() }}"></script> --}}
    {{-- <script src="{{ asset() }}"></script> --}}
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
@endpush
