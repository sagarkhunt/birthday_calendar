@extends('layouts.admin')
@section('title')
    Create User
@endsection
@section('css')
@endsection
@section('content')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ URL::to('admin/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ URL::to('admin/birthday-management') }}">Birthday</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Birthdate</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Birthdate</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0 mb-1">Birthdate Form</h4>

                    <hr />

                    {{ Form::open(['url' => 'admin/birthday-management', 'method' => 'post', 'name' => 'create-category', 'files' => 'true', 'class' => 'needs-validation', 'novalidate']) }}
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group mb-3">
                                <label for="validationCustom01">Name</label>
                                {{ Form::text('name', '', ['class' => 'form-control', 'id' => 'validationCustom01', 'placeholder' => 'Name', 'required']) }}

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-3">
                                <label for="validationCustom01">BirthdayDate</label>
                                {{ Form::date('birthday_date', '', ['class' => 'form-control', 'id' => '', 'placeholder' => 'Select date', 'required']) }}

                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-lg-4">

                            <div class="form-group mb-3">
                                <label for="validationCustom01">Description</label>
                                {{ Form::textarea('description', '', ['class' => 'form-control', 'id' => '', 'placeholder' => 'Enter description']) }}

                            </div>
                        </div>

                    </div>



                    {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                    <a href="{{ URL::to('admin/birthday-management') }}" class="btn btn-danger">Cancel</a>
                    {{ Form::close() }}

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
@endsection

@section('plugin')
    <!-- Plugin js-->
    <script src="{{ URL::to('storage/app/public/Adminassets/libs/parsleyjs/parsley.min.js') }}"></script>
@endsection
@section('js')
    <!-- Validation init js-->
    <script src="{{ URL::to('storage/app/public/Adminassets/js/pages/form-validation.init.js') }}"></script>

    <script>
        $('input[type="file"]').change(function(e) {

            var fileName = e.target.files[0].name;
            $('.custom-file-label').text(fileName);

        });
    </script>
@endsection
