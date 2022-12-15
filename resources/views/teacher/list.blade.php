@extends('layouts.app')

@section('title', 'Teacher List')

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
                            <th>Teacher Name</th>
                            <th>Title</th>
                            <th>Department</th>
                            <th>Conatact</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teachers as $teacher)
                        <tr>
                            <td>

                            </td>
                            <td>
                                {{ $teacher->name }}
                            </td>
                            <td>
                                {{ $teacher->title }}
                            </td>
                            <td>
                                {{ $teacher->department->name }}
                            </td>
                            <td>
                                {{ $teacher->contact }}
                            </td>
                            <td>
                                {{ $teacher->email }}
                            </td>
                            <td>
                                <form action="{{ route('teacher.destroy',$teacher->id) }}" method="Post">

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
