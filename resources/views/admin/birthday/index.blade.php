@extends('layouts.admin')
@section('title')
    Birthday Management
@endsection
@section('css')
    <!-- plugin css -->
    <link href="{{ URL::to('storage/app/public/Adminassets/libs/datatables/dataTables.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('storage/app/public/Adminassets/libs/datatables/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right">
                <a href="{{ URL::to('admin/birthday-management/create') }}" class="btn btn-primary text-white">+ Create
                    Birthday</a>
            </nav>
            <h4 class="mb-1 mt-1">Birthday</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if (Session::has('message'))
                {!! Session::get('message') !!}
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0 mb-1">Birthday</h4>


                    <table id="basic-datatable" class="table dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>BirthDate</th>
                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody>

                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->birthday_date }}</td>

                                    <td>
                                        <a class=""
                                            href="{{ URL::to('admin/birthday-management/' . $row->id . '/edit') }}"> <i
                                                class="uil-pen"></i></a>
                                        <a class=""
                                            href="{{ URL::to('admin/birthday-management/' . $row->id . '/destroy') }}"><i
                                                class="uil-trash-alt"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
@endsection

@section('plugin')
    <!-- datatable js -->
    <script src="{{ URL::to('storage/app/public/Adminassets/libs/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::to('storage/app/public/Adminassets/libs/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::to('storage/app/public/Adminassets/libs/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::to('storage/app/public/Adminassets/libs/datatables/responsive.bootstrap4.min.js') }}"></script>
@endsection
@section('js')
    <!-- Datatables init -->
    <script src="{{ URL::to('storage/app/public/Adminassets/js/pages/datatables.init.js') }}"></script>
@endsection
