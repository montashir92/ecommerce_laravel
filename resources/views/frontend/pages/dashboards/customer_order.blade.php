@extends('frontend.layouts.master')
@section('main_content')

@section('title')
FurnishFurniture - My Order
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
        My Order
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

                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Total Amount</th>
                                        <th>Payment Method</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <td>#{{ $order->order_no }}</td>
                                        <td>$<?php echo number_format($order->order_total, 2); ?></td>
                                        <td>
                                            {{ $order->payment->payment_method }}
                                            @if($order->payment->payment_method == "bkash")
                                            (Transaction : {{ $order->payment->transaction_no }})
                                            @endif
                                        </td>
                                        <td>
                                            @if($order->status == 0)
                                            <span class="badge badge-warning">Unapproved</span>
                                            @elseif($order->status == 1)
                                            <span class="badge badge-success">Approved</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ route('customer.order.details', $order->id) }}" title="Details" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('customer.order.print', $order->id) }}" target="_blank" title="Print" class="btn btn-success btn-sm"><i class="fa fa-download"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

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