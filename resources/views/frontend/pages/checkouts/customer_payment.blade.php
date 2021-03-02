@extends('frontend.layouts.master')
@section('main_content')

@section('title')
FurnishFurniture - Payment Method
@endsection

<style type="text/css">
	.sss{
		float: left;
	}
	.s888{
		height: 40px;
		border: 1px solid #e6e6e6;
	}
</style>

<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('public/frontend/images/bg-01.jpg') }}');">
    <h2 class="ltext-105 cl0 txt-center">
        Payment Method
    </h2>
</section>

<!-- Shoping Cart -->
<div class="bg0 p-t-75 p-b-85">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12" style="padding-bottom: 30px;">
                <div class="wrap-table-shopping-cart">
                    <table class="table-shopping-cart">
                        <tr class="table_head">
                            <th class="text-center">Image</th>
                            <th class="text-center">Product</th>
                            <th class="text-center">Size</th>
                            <th class="text-center">Color</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Action</th>
                        </tr>
                        @php
                        $contents = Cart::content();
                        $total_price = 0;
                        @endphp
                        
                        @foreach($contents as $content)
                        <tr class="table_row">
                            <td class="column-1">
                                <div class="how-itemcart1">
                                    <img src="{{ asset('images/products/'.$content->options->image) }}" alt="IMG">
                                </div>
                            </td>
                            <td class="text-center">{{ $content->name }}</td>
                            <td class="text-center">{{ $content->options->size_name }}</td>
                            <td class="text-center">{{ $content->options->color_name }}</td>
                            <td class="text-center">$ {{ number_format($content->price, 2) }}</td>
                            <td class="text-center">
                                <form action="{{ route('cart.update') }}" method="post">
                                @csrf
                                <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                    
                                    <input type="hidden" name="rowId" value="{{ $content->rowId }}">
                                    <input class="mtext-104 cl3 txt-center num-product sss" type="number" name="qty" value="{{ $content->qty }}">
                                    <input type="submit" class="flex-c-m stext-101 c12 bg8 s888 hov-btn3 p-lr-15 trans-04 pointer m-tb-10" value="Update">

                                </div>
                              </form>
                            </td>
                            <td class="text-center">$ {{ number_format($content->subtotal, 2) }}</td>
                            <td class="text-center">
                               <a onclick="return confirm('Are You Sure to Delete?');" href="{{ route('cart.delete', $content->rowId) }}" class="btn btn-danger"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        @php
                        $total_price += $content->subtotal;
                        @endphp
                        
                        @endforeach

                        <tr>
                            <td colspan="6" class="text-center"><strong>Grand Total</strong></td>
                            <td colspan="2">${{ number_format($total_price, 2) }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            
        </div>
        
        <div class="row">
            <div class="col-md-4">
                <h3>Select Payment Method</h3>
            </div>
            
            <div class="col-md-5">
                @if(Session::get('message'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Error : </strong> {{ Session::get('message') }}
                </div>
                @endif
                
                <form action="{{ route('customer.payment.store') }}" method="post" id="myForm">
                    @csrf
                    
                    @foreach($contents as $content)
                    <input type="hidden" name="product_id" value="{{ $content->id }}">
                    @endforeach
                    
                    <input type="hidden" name="order_total" value="{{ $total_price }}">
                    
                    <select class="form-control" name="payment_method" id="payment_method">
                        <option value="">Select Payment Method</option>
                        <option value="cash_in">Hand Cash</option>
                        <option value="bkash">Bkash</option>
                    </select>
                    
                    <font style="color: red">{{ ($errors->has('payment_method')) ? ($errors->first('payment_method')) : '' }}</font>
                    
                    <div class="show_field" style="display: none">
                        <span>Bkash No. 01734455667</span>
                        <input type="text" name="transaction_no" class="form-control" placeholder="Write Transaction No">
                    </div>
                    
                    <button type="submit" class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10 mt-4">Order Now</button>
                    
                </form>
            </div>
        </div>
    </div>
</div>



@endsection

@section('scripts')

<script>
    $(document).on('change', '#payment_method', function(){
        var payment_method = $(this).val();
        if(payment_method == 'bkash')
        {
            $('.show_field').show();
        }else{
            $('.show_field').hide();
        }
    });
</script>

<script>
$(function () {
  
  $('#myForm').validate({
    rules: {

      payment_method: {
        required: true
      }
    },

    messages: {
      
      payment_method: {
        required: "Please Enter a Payment Method"
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