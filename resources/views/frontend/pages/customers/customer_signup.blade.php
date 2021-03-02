@extends('frontend.layouts.master')
@section('main_content')

@section('title')
FurnishFurniture - Customer Signup Page
@endsection


<style type="text/css" media="screen">

    #login .container #login-row #login-column #login-box {
        margin-bottom: 40px;
        margin-top: 40px;
        max-width: 600px;
        min-height: 320px;
        border: 1px solid #9C9C9C;
        background-color: #EAEAEA;
    }
    #login .container #login-row #login-column #login-box #login-form {
        padding: 20px;
    }
    #login .container #login-row #login-column #login-box #login-form #register-link {
        margin-top: -85px;
    }
</style>

<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('public/frontend/images/bg-01.jpg')  }}');">
    <h2 class="ltext-105 cl0 txt-center">
        User Signup Form
    </h2>
</section>


<div id="login">

    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" action="{{ route('customer.signup.store') }}" method="post">

                        @csrf

                        <h3 class="text-center text-info">Signup</h3>

                        <div class="form-group">
                            <label for="name" class="text-info">Full Name:</label><br>
                            <input type="text" name="name" id="name" class="form-control">
                            <font style="color: red">{{ ($errors->has('name')) ? ($errors->first('name')) : '' }}</font>
                        </div>

                        <div class="form-group">
                            <label for="email" class="text-info">Email Address:</label><br>
                            <input type="email" name="email" id="email" class="form-control">
                            <font style="color: red">{{ ($errors->has('email')) ? ($errors->first('email')) : '' }}</font>
                        </div>

                        <div class="form-group">
                            <label for="mobile" class="text-info">Mobile Number:</label><br>
                            <input type="text" name="mobile" id="mobile" class="form-control">
                            <font style="color: red">{{ ($errors->has('mobile')) ? ($errors->first('mobile')) : '' }}</font>
                        </div>

                        <div class="form-group">
                            <label for="password" class="text-info">Password:</label><br>
                            <input type="password" name="password" id="password" class="form-control">
                            <font style="color: red">{{ ($errors->has('password')) ? ($errors->first('password')) : '' }}</font>
                        </div>

                        <div class="form-group">
                            <label class="text-info">Confirm Password:</label><br>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                            <font style="color: red">{{ ($errors->has('confirm_password')) ? ($errors->first('confirm_password')) : '' }}</font>
                        </div>



                        <div class="form-group">

                            <input type="submit" name="submit" class="btn btn-info btn-md" value="Register">
                            <i class="fa fa-user"></i> Have You Account ? <a href="{{ route('customer.login') }}"><span>Login Here</span></a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@section('scripts')

<script>
    $(function () {

        $('#login-form').validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 8
                },
                confirm_password: {
                    required: true,
                    equalTo: '#password'
                },
                mobile: {
                    required: true
                }

            },

            messages: {
                name: {
                    required: "Please Provide a User Name"
                },
                email: {
                    required: "Please Provide a User Email",
                    email: "Please provide A Vaild Email"
                },
                password: {
                    required: "Please Provide a User Password",
                    minlength: "password will be 8 Character"
                },
                confirm_password: {
                    required: "Please Provide a Confirm Password",
                    equalTo: "Confirm Password Does Not Match!"
                },
                mobile: {
                    required: "Please Enter Your Mobile Number"
                }

            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>

@endsection