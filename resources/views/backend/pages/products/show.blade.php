@extends('backend.layouts.admin_master')
@section('admin_content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Manage Product</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Product</li>
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
                <h3 class="card-title"><i class="fas fa-info-circle"></i> Product Information</h3>
                <a href="{{ route('admin.products') }}" class="btn btn-info btn-sm float-right"><i class="fas fa-list"></i> Product List</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="" class="table table-bordered table-striped">
                  
                  <tr>
                    <th width="30%">Category</th>
                    <td>{{ $product->category->name }}</td>
                  </tr>
                  
                  <tr>
                    <th width="30%">Brand</th>
                    <td>{{ $product->brand->name }}</td>
                  </tr>
                  
                  <tr>
                    <th width="30%">Product</th>
                    <td>{{ $product->name }}</td>
                  </tr>
                  
                  <tr>
                    <th width="30%">Price</th>
                    <td>{{ $product->price }}</td>
                  </tr>
                  
                  <tr>
                    <th width="30%">Short Desc</th>
                    <td>{{ $product->short_desc }}</td>
                  </tr>
                  
                  <tr>
                    <th width="30%">Long Desc</th>
                    <td>{!! $product->long_desc !!}</td>
                  </tr>
                  
                  <tr>
                    <th width="30%">Image</th>
                    <td><img src="{{ asset('images/products/'.$product->image) }}" width="100" height="100" alt=""></td>
                  </tr>
                  
                  <tr>
                    <th width="30%">Color</th>
                    <td>
                        @php
                        $colors = App\Models\ProductColor::where('product_id', $product->id)->get();
                        @endphp
                        
                        @foreach($colors as $color)
                        {{ $color['color']['name'] }},
                        @endforeach
                    </td>
                  </tr>
                  
                  <tr>
                    <th width="30%">Size</th>
                    <td>
                        @php
                        $sizes = App\Models\ProductSize::where('product_id', $product->id)->get();
                        @endphp
                        
                        @foreach($sizes as $size)
                        {{ $size['size']['name'] }},
                        @endforeach
                    </td>
                  </tr>
                  
                  <tr>
                    <th width="30%">Sub Image</th>
                    <td>
                        @php
                        $sub_image = App\Models\ProductImage::where('product_id', $product->id)->get();
                        @endphp
                        
                        @foreach($sub_image as $sub_img)
                        <img src="{{ asset('images/sub_products/'.$sub_img->sub_image) }}" width="100" alt="">
                        @endforeach
                    </td>
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



