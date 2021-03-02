@extends('frontend.layouts.master')
@section('main_content')

@section('title')
FurnishFurniture - Checkout Page
@endsection

<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('public/frontend')  }}/images/bg-01.jpg');">
    <h2 class="ltext-105 cl0 txt-center">
        Customer Billing Information
    </h2>
</section>
<!-- Content page -->
<section class="bg0 p-t-104 p-b-116">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-md-2">

                    </div>

                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                Billing Address
                            </div>

                            <div class="card-body">
                                <form action="{{ route('customer.checkout.store') }}" method="post" id="myForm">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-8 mb-3">
                                            <label><strong>Full Name</strong></label>
                                            <input type="text" name="name" id="name" class="form-control" >
                                            <font style="color: red">{{ ($errors->has('name')) ? ($errors->first('name')) : '' }}</font>
                                        </div>

                                        <div class="col-md-8 mb-3">
                                            <label><strong>Email Address</strong></label>
                                            <input type="email" name="email" id="email" class="form-control">
                                            <font style="color: red">{{ ($errors->has('email')) ? ($errors->first('email')) : '' }}</font>
                                        </div>

                                        <div class="col-md-8 mb-3">
                                            <label><strong>Mobile Number</strong></label>
                                            <input type="text" name="mobile" id="mobile" class="form-control">
                                            <font style="color: red">{{ ($errors->has('mobile')) ? ($errors->first('mobile')) : '' }}</font>
                                        </div>

                                        <div class="col-md-8 mb-3">
                                            <label><strong>Address</strong></label>
                                            <input type="text" name="address" id="address" class="form-control">
                                            <font style="color: red">{{ ($errors->has('address')) ? ($errors->first('address')) : '' }}</font>
                                        </div>


                                        <div class="col-md-8">
                                            <button type="submit" class="btn btn-primary">Save change</button>
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
</section>

@endsection

@section('scripts')

<script>
    $(function () {

        $('#myForm').validate({
            rules: {
                name: {
                    required: true
                },
                mobile: {
                    required: true
                },
                address: {
                    required: true
                }

            },

            messages: {
                name: {
                    required: "Please Provide a Billing Name"
                },
                mobile: {
                    required: "Please Provide a Mobile Number"
                },
                address: {
                    required: "Please Provide a Address",
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
