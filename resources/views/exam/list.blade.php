@extends('layouts.app')

@section('title', 'Exam List')

@push('style')
    <!-- CSS Libraries -->

    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/select.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">

@endpush

@section('main')



    <div class="card">
        <div class="card-header">
            {{-- <h4>HTML5 Form Basic</h4> --}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table-striped table" id="table-1">
                    <thead>
                        <tr>
                            <th class="text-center">
                                #
                            </th>
                            <th>Exam Name</th>
                            <th>Exam Year</th>
                            <th>Batch</th>
                            <th>Year</th>
                            <th>Semester</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($exams as $exam)
                            <tr>
                                <td>
                                    {{ $i++ }}
                                </td>
                                <td>{{ $exam->name }}</td>
                                <td class="align-middle">
                                    {{ $exam->exam_year }}
                                </td>
                                <td>
                                    {{ $exam->batch->name }}
                                </td>
                                <td>{{ $exam->year }}</td>
                                <td>
                                    {{ $exam->semester }}
                                </td>
                                <td>
                                    <a href="{{ route('exam.print', $exam) }}" class="btn btn-sm btn-warning"><i class="fa-solid fa-print"></i></a>
                                    <a href="{{ route('exam.edit', $exam) }}" class="btn btn-sm btn-info"><i class="fa-solid fa-pen"></i></a>

                                    <form action="{{ route('exam.destroy', $exam) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Are you want to delete?');"
                                            class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
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
