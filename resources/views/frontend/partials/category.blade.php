<div class="flex-w flex-sb-m p-b-52">
    <div class="flex-w flex-l-m filter-tope-group m-tb-10">
        <a href="{{ route('products') }}" class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1">
            All Products
        </a>
        @foreach($categories as $category)
        <a href="{{ route('categories.show', $category->category_id) }}" class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5">
            {{ $category->category->name }}
        </a>
        @endforeach
    </div>

    @include('frontend.partials.search')

    <!-- Filter -->
    <div class="dis-none panel-filter w-full">
        <div class="wrap-filter flex-w w-full" style="background-color: #858585;">
            <div>
                <div style="padding: 20px; font-size: 25px; color: #fff">
                    Brands
                </div>
                <div style="padding: 0px 20px 20px 20px;">
                    @foreach($brands as $brand)
                    <a class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" href="{{ route('brands.show', $brand->brand_id) }}" class="filter-link stext-106 trans-04" style="color: #fff">
                        {{ $brand->brand->name }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>