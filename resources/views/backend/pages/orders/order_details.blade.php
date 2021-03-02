@extends('backend.layouts.admin_master')
@section('admin_content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Manage Order Details</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Details</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">


                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-list"></i> Order Details Info</h3>
                        <a href="{{ route('admin.order.approved') }}" class="btn btn-success btn-sm float-right"><i class="fas fa-list"></i> Order Lisr</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered">
                            

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
                                    
                                    @endif &nbsp;&nbsp;&nbsp;
                                    <strong>Order No : </strong>#{{ $orders->order_no }}
                                </td>
                            </tr>

                            <tr class="text-center">
                                <td colspan="3"><h4><strong>Order Details</strong></h4></td>
                            </tr>

                            <tr class="text-center">
                                <td><strong>Product name & Image</strong></td>
                                <td><strong>Color & Size</strong></td>
                                <td><strong>Quantity & Price</strong></td>
                            </tr>
                            @foreach($orders->order_details as $detail)
                            <tr class="text-center">
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
                                <td class="text-center"><strong>$<?php echo number_format($orders->order_total, 2); ?> /-</strong></td>
                            </tr>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

@endsection


@section('admin_script')
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
@endsection

