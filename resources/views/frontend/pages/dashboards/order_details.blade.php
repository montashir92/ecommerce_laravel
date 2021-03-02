@extends('frontend.layouts.master')
@section('main_content')

@section('title')
FurnishFurniture - Order Details
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
    .mytable tr td{
        padding: 10px;
    }
</style>

<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('public/frontend')  }}/images/bg-01.jpg');">
    <h2 class="ltext-105 cl0 txt-center">
        Order Details
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
            <table class="text-center mytable" width="100%" border="1">
                
                <tr>
                    <td width="30%">
                        <img src="{{ asset('public/frontend') }}/images/logo/logo.png" alt="IMG-LOGO">
                    </td>
                    <td width="40%">
                        <h3><strong>FurnishFuniture</strong></h3>
                        <span><strong>Mobile No : </strong>01723344556</span><br>
                        <span><strong>Email : </strong>laraveldevelopment2@gmail.com</span><br>
                        <span><strong>Address : </strong>Uttara sectore-12, Dhaka: 1230</span>
                    </td>
                    <td width="30%"><strong>Order No : </strong>#{{ $orders->order_no }}</td>
                </tr>
                
                <tr>
                    <td><strong>Billing Information</strong></td>
                    <td colspan="2" class="text-left">
                        <strong>Name : </strong> {{ $orders->shipping->name }} &nbsp;&nbsp;&nbsp;
                        <strong>Email : </strong> {{ $orders->shipping->email }}<br>
                        <strong>Mobile : </strong> {{ $orders->shipping->mobile }}&nbsp;&nbsp;&nbsp;
                        <strong>Address : </strong> {{ $orders->shipping->address }}<br>
                        <strong>Payment Method : </strong> {{ $orders->payment->payment_method }}
                        @if($orders->payment->payment_method == "bkash")
                        (Transaction No : {{ $orders->payment->transaction_no }})
                        @endif
                    </td>
                </tr>
                
                <tr>
                    <td colspan="3"><h4><strong>Order Details</strong></h4></td>
                </tr>
                
                <tr>
                    <td><strong>Product name & Image</strong></td>
                    <td><strong>Color & Size</strong></td>
                    <td><strong>Quantity & Price</strong></td>
                </tr>
                
                @foreach($orders->order_details as $detail)
                <tr>
                    <td>
                        <img src="{{ asset('images/products/'.$detail->product->image) }}" width="50" height="50" alt="">&nbsp;&nbsp;
                        {{ $detail->product->name }}
                    </td>
                    
                    <td>
                        <strong>Color : </strong>{{ $detail->color->name }}
                        & 
                        <strong>Size : </strong>{{ $detail->size->name }}
                    </td>
                    <td>
                        @php
                        $total = $detail->quantity * $detail->product->price;
                        @endphp
                        {{ $detail->quantity }} x ${{ $detail->product->price }} = $<?php echo number_format($total, 2); ?>
                    </td>
                </tr>
                @endforeach
                
                <tr>
                    <td colspan="2" class="text-right"><strong>Grand Total = </strong></td>
                    <td><strong>${{ number_format($orders->order_total, 2) }} /-</strong></td>
                </tr>
                
            </table>

        </div>
    </div>

</div>


@endsection

