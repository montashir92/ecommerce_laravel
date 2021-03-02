<div class="flex-w flex-c-m m-tb-10">
    <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
        <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
        <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
        Filter
    </div>

    <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
        <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
        <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
        Search
    </div>
</div>

<!-- Search product -->
<div class="dis-none panel-search w-full p-t-10 p-b-15">
    <div class="bor8 dis-flex p-l-15">
        <form action="{{ route('product.search') }}" method="post">
            @csrf
            
            <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                <i class="zmdi zmdi-search"></i>
            </button>

            <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search" id="slug" autocomplete="off" placeholder="Search">
        </form>
    </div>
    
    <div class="col-md-5" id="productStatus">
        
    </div>
</div>

@section('scripts')
<script>
    $(document).ready(function(){
        $("#slug").keyup(function(){
            var slug = $(this).val();
            if(slug !='')
            {
                $.ajax({
                    url: "{{ route('product.get') }}",
                    type: "GET",
                    data: {slug:slug},
                    success: function(data){
                        $("#productStatus").fadeIn();
                        $("#productStatus").html(data);
                    }
                });
            }
        });
    });
    
    $(document).on('click', 'li', function(){
        $("#slug").val($(this).text());
        $("#productStatus").fadeOut();
    });
</script>
@endsection