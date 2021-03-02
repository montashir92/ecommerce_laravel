@extends('frontend.layouts.master')
@section('main_content')

@section('title')
FurnishFurniture - Product Cart
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
        Shopping Cart
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

                        
                    </table>
                </div>
            </div>

            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="wrap-table-shopping-cart">
                    <table class="table-shopping-cart">
                        <tr class="table_head">
                            <th class="column-1">
                                <h5>What would you like to do next?</h5>
                                <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
                            </th>
                        </tr>
                        <tr class="table_row">
                            <td class="column-1">
                                <div class="total_area">
                                    <ul>
                                        <li>Cart Sub Total <span>{{ number_format($total_price, 2) }} Tk</span></li>
                                        <li>Eco Tax <span>0.00</span> Tk</li>
                                        <li>Shipping Cost <span>Free</span></li>
                                        <li>Total <span>{{ number_format($total_price, 2) }} Tk</span></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                    <div class="flex-w flex-m m-r-20 m-tb-5">
                        <a href="{{ route('products') }}" class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">Continue Shopping</a>
                        &nbsp;&nbsp;
                        
                        @if(@Auth::user()->id != NULL && Session::get('shipping_id') == NULL)
                        <a href="{{ route('customer.checkouts') }}" class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">Checkout</a>
                        @elseif(@Auth::user()->id != NULL && Session::get('shipping_id') != NULL)
                        <a href="{{ route('customer.payment') }}" class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">Checkout</a>
                        @else
                        <a href="{{ route('customer.login') }}" class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">Checkout</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection