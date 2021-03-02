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
        Update Profile 
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
                            <form action="{{ route('customer.update.profile') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-8 mb-3">
                                        <label><strong>Full Name</strong></label>
                                        <input type="text" name="name" value="{{ $user->name }}" class="form-control" >
                                        <font style="color: red">{{ ($errors->has('name')) ? ($errors->first('name')) : '' }}</font>
                                    </div>

                                    <div class="col-md-8 mb-3">
                                        <label><strong>Email Address</strong></label>
                                        <input type="email" name="email" value="{{ $user->email }}" class="form-control">
                                        <font style="color: red">{{ ($errors->has('email')) ? ($errors->first('email')) : '' }}</font>
                                    </div>

                                    <div class="col-md-8 mb-3">
                                        <label><strong>Mobile Number</strong></label>
                                        <input type="text" name="mobile" value="{{ $user->mobile }}" class="form-control">
                                        <font style="color: red">{{ ($errors->has('mobile')) ? ($errors->first('mobile')) : '' }}</font>
                                    </div>

                                    <div class="col-md-8 mb-3">
                                        <label><strong>Address</strong></label>
                                        <input type="text" name="address" value="{{ $user->address }}" class="form-control">
                                        <font style="color: red">{{ ($errors->has('address')) ? ($errors->first('address')) : '' }}</font>
                                    </div>

                                    <div class="col-md-8 mb-3">
                                        <label><strong>Gender</strong></label>
                                        <select name="gender" class="form-control">
                                            <option value="">Select Your Gender</option>
                                            <option value="Male" {{ ($user->gender == "Male") ? "selected" : "" }}>Male</option>
                                            <option value="Female" {{ ($user->gender == "Female") ? "selected" : "" }}>Female</option>
                                        </select>
                                        <font style="color: red">{{ ($errors->has('gender')) ? ($errors->first('gender')) : '' }}</font>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <label><strong>Image</strong></label>
                                                <input type="file" name="image" id="image" class="form-control">
                                                <font style="color: red">{{ ($errors->has('image')) ? ($errors->first('image')) : '' }}</font>

                                            </div>

                                            <div class="col-md-4">
                                                <img src="{{ (!empty($user->image)) ? asset('images/users/'.$user->image) : asset('images/default/no.jpg') }}" style="border: 1px solid #666;" class="float-right" width="100" height="100" id="showImage" alt="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <button type="submit" class="btn btn-primary">Update Profile</button>
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
    $(document).ready(function () {
        $("#image").change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection