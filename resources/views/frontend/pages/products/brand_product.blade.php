@extends('frontend.layouts.master')
@section('main_content')

@section('title')
FurnishFurniture - Brand Products
@endsection

<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('public/frontend/images/bg-01.jpg') }}');">
    <h2 class="ltext-105 cl0 txt-center">
        Brand Products
    </h2>
</section>	

<!-- Content page -->
<section class="bg0 p-t-104 p-b-116">
    <div class="container">
        @include('frontend.partials.category')

        <div class="row isotope-grid">
            @foreach($products as $product)
            <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                <!-- Block2 -->
                <div class="block2">
                    <div class="block2-pic hov-img0">
                        <img src="{{ asset('images/products/'.$product->image) }}" alt="IMG-PRODUCT">

                        <a href="{{ route('product.show', $product->slug) }}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
                            Add to Card
                        </a>
                    </div>

                    <div class="block2-txt flex-w flex-t p-t-14">
                        <div class="block2-txt-child1 flex-col-l ">
                            <a href="{{ route('product.show', $product->slug) }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                {{ $product->name }}
                            </a>

                            <span class="stext-105 cl3">
                                ${{ $product->price }}
                            </span>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>	



@endsection
