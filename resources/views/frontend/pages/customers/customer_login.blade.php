@extends('frontend.layouts.master')
@section('main_content')

@section('title')
FurnishFurniture - Customer Login Page
@endsection

<style type="text/css" media="screen">

    #login .container #login-row #login-column #login-box {
        margin-bottom: 40px;
        margin-top: 40px;
        max-width: 600px;
        height: 320px;
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
        User Login Form
    </h2>
</section>


<div id="login">

    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">

                    <form id="login-form" class="form" method="POST" action="{{ route('login') }}">
                        @csrf

                        <h3 class="text-center text-info">Login</h3>
                        <div class="form-group">
                            <label for="email" class="text-info">Email Address:</label><br>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Password:</label><br>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group">

                            <input type="submit" name="submit" class="btn btn-info btn-md" value="Login">
                            <i class="fa fa-user"></i> No Account yet? <a href="{{ route('customer.signup') }}"><span>Signup New Account</span></a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection