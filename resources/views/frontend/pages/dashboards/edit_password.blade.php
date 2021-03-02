@extends('frontend.layouts.master')
@section('main_content')

@section('title')
FurnishFurniture - Update Customer
@endsection

<style>
    .proft li{
        background: #1781BF;
        padding: 7px;
        margin: 3px;
        border-radius: 6px;
    }

    .proft li a{
        color: #fff;
        padding-left: 15px;
    }

    .img-circle img{
        text-align: center;
        width: 150px;
        height: 150px;
        border: 1px solid #444;
        border-radius: 50%;
        padding: 2px;
        margin-bottom: 10px;
    }
</style>

<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('public/frontend')  }}/images/bg-01.jpg');">
    <h2 class="ltext-105 cl0 txt-center">
        Change Password 
    </h2>
</section>



<div class="container mt-4 mb-4">

    <div class="row">
        <div class="col-md-2">
            <ul class="proft">
                <li><a href="{{ route('customer.dashboard') }}">My Profile</a></li>
                <li><a href="{{ route('customer.change.password') }}">Password Change</a></li>
                <li><a href="{{ route('customer.order.list') }}">My Order</a></li>
            </ul>
        </div>

        <div class="col-md-10">
            <div class="row">
                <div class="col-md-2">

                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('customer.update.password') }}" method="post" id="myForm">
                                @csrf

                                <div class="form-row">


                                    <div class="form-group col-md-4">
                                        <label for="current_password">Current Password</label>
                                        <input type="password" name="current_password" id="current_password" class="form-control">
                                        <font style="color: red">{{ ($errors->has('current_password')) ? ($errors->first('current_password')) : '' }}</font>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="new_password">New Password</label>
                                        <input type="password" name="new_password" id="new_password" class="form-control">
                                        <font style="color: red">{{ ($errors->has('new_password')) ? ($errors->first('new_password')) : '' }}</font>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="again_new_password">Again New Password</label>
                                        <input type="password" name="again_new_password" class="form-control">

                                    </div>

                                    <div class="form-group col-md-6">

                                        <input type="submit" value="Update change" class="btn btn-success">

                                    </div>

                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>


@endsection

@section('scripts')

<script>
$(function () {
  
  $('#myForm').validate({
    rules: {

      current_password: {
        required: true
      },
      new_password: {
        required: true,
        minlength: 8
      },
      again_new_password: {
        required: true,
        equalTo: '#new_password'
      }
    },

    messages: {
      
      current_password: {
        required: "Please Enter a Current Password"
      },
      new_password: {
        required: "Please Enter a New Password",
        minlength: "Password will be minimum 8 characters"
      },
      again_new_password: {
        required: "Please Enter a Again New Password",
        equalTo: "Again New Password Does Not Match!!"
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