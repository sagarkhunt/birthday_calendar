<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8" />
    <title>Login - Calendar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Calendar" name="description" />
    <meta content="Calendar" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->

    <!-- App css -->
    <link href="{{ URL::to('storage/app/public/Adminassets/css/bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::to('storage/app/public/Adminassets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('storage/app/public/Adminassets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

</head>

<body class="authentication-bg">

    <div class="account-pages my-5">
        <div class="container" id="kt_login">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-md-3 p-5"></div>
                                <div class="col-md-6 p-5">

                                    <h6 class="h5 mb-0 mt-0">Login</h6>


                                    <!-- <form action="#" class="authentication-form"> -->
                                    {{ Form::open(['class' => 'authentication-form mt-3', 'url' => URL::to('register'), 'method' => 'POST']) }}
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-control-label">Email Address</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="icon-dual" data-feather="mail"></i>
                                                </span>
                                            </div>
                                            {{ Form::email('email', '', ['class' => 'form-control', 'id' => 'emailAddress', 'parsley-type' => 'email', 'autocomplete' => 'off', 'placeholder' => 'hello@gmail.com']) }}
                                        </div>
                                    </div>

                                    <div class="form-group mt-4">
                                        <label class="form-control-label">Password</label>
                                        <!-- <a href="#" class="float-right text-muted text-unline-dashed ml-1">Forgot your password?</a> -->
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="icon-dual" data-feather="lock"></i>
                                                </span>
                                            </div>
                                            {{ Form::password('password', ['class' => 'form-control', 'id' => 'hori-pass1', 'placeholder' => 'Enter your password']) }}
                                        </div>
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" id="kt_login_signin_submit"> Log In
                                        </button>
                                    </div>
                                    {{ Form::close() }}
                                    <!-- </form> -->
                                    {{-- <div class="py-3 text-center"><span class="font-size-16 font-weight-bold">Or</span>
                                    </div> --}}
                                </div>
                            </div>

                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->


    <!-- Vendor js -->
    <script src="{{ URL::to('storage/app/public/Adminassets/js/vendor.min.js') }}"></script>

    <!-- Plugin js-->
    <script src="{{ URL::to('storage/app/public/Adminassets/libs/parsleyjs/parsley.min.js') }}"></script>

    <!-- Validation init js-->
    <script src="{{ URL::to('storage/app/public/Adminassets/js/pages/form-validation.init.js') }}"></script>

    <script src="{{ URL::to('storage/app/public/Adminassets/js/pages/jquery.validate.min.js') }}"></script>
    <!-- App js -->
    <script src="{{ URL::to('storage/app/public/Adminassets/js/app.min.js') }}"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script type="text/javascript">
        "use strict";

        // Class Definition
        var KTLoginGeneral = function() {

            var login = $('#kt_login');

            var showMsg = function(form, type, msg) {
                var alert = $('<div class="alert alert-' + type +
                    ' alert-dismissible" role="alert">\
                                                                                                                                                                                    <div class="alert-text">' +
                    msg +
                    '</div>\
                                                                                                                                                                                    <div class="alert-close">\
                                                                                                                                                                                        <i class="flaticon2-cross kt-icon-sm" data-dismiss="alert"></i>\
                                                                                                                                                                                    </div>\
                                                                                                                                                                                </div>'
                );

                form.find('.alert').remove();
                alert.prependTo(form);
                //alert.animateClass('fadeIn animated');
                // KTUtil.animateClass(alert[0], 'fadeIn animated');
                alert.find('span').html(msg);
            }

            var handleSignInFormSubmit = function() {
                $('#kt_login_signin_submit').click(function(e) {
                    e.preventDefault();
                    var btn = $(this);
                    var form = $(this).closest('form');
                    console.log(form);
                    form.validate({
                        rules: {
                            email: {
                                required: true,
                                email: true
                            },
                            password: {
                                required: true
                            }
                        }
                    });

                    if (!form.valid()) {
                        return;
                    }

                    btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr(
                        'disabled', true);

                    $.ajax({
                            url: "{{ URL::to('admin/login') }}",
                            type: 'post',
                            dataType: 'json',
                            data: form.serialize(),
                        }).done(function(response) {
                            if (typeof response != "undefined") {
                                if (response.status) {
                                    showMsg(form, 'success', 'Login successfully.');
                                    window.location.href = "{{ url('admin/birthday-management') }}";
                                } else {
                                    showMsg(form, 'danger',
                                        'Incorrect email or password. Please try again.');
                                }
                            }
                        })
                        .fail(function() {
                            showMsg(form, 'danger', 'Incorrect email or password. Please try again.');
                        })
                        .always(function() {
                            setTimeout(function() {
                                btn.removeClass(
                                    'kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light'
                                ).attr('disabled', false);
                            }, 1000);
                        });
                });
            }

            // Public Functions
            return {
                // public functions
                init: function() {
                    handleSignInFormSubmit();
                }
            };
        }();

        // Class Initialization
        jQuery(document).ready(function() {
            KTLoginGeneral.init();
        });
    </script>

</body>

</html>
