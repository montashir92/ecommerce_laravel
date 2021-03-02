@extends('frontend.layouts.master')
@section('main_content')

<!-- Slider -->
@include('frontend.partials.slider')

<!-- Product -->
<section class="bg0 p-t-23 p-b-140">
    <div class="container">
        
        @include('frontend.partials.category')

        @include('frontend.pages.products.partials.all_product')
    </div>
</section>
@endsection
