@extends('frontend.layouts.master')
@section('main_content')

@section('title')
FurnishFurniture - All Products
@endsection

<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('public/frontend/images/bg-01.jpg') }}');">
    <h2 class="ltext-105 cl0 txt-center">
        All Products
    </h2>
</section>	

<!-- Content page -->
<section class="bg0 p-t-104 p-b-116">
    <div class="container">
        @include('frontend.partials.category')

        @include('frontend.pages.products.partials.all_product')
    </div>
</section>	



@endsection