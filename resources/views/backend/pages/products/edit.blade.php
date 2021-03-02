@extends('backend.layouts.admin_master')
@section('admin_content')


  <!-- Content Header (Page header) -->
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

   <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            

            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-edit"></i> Update Product</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <form action="{{ route('admin.product.update', $product->id) }}" method="post" id="myForm" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group row">
                      <label for="name" class="col-sm-2 col-form-label">Product Name</label>
                      <div class="col-sm-8">
                          <input type="text" name="name" value="{{ $product->name }}" class="form-control" id="name">
                          <font style="color: red">{{ ($errors->has('name')) ? ($errors->first('name')) : '' }}</font>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="short_desc" class="col-sm-2 col-form-label">Short Description</label>
                      <div class="col-sm-8">
                          <textarea class="form-control" rows="2" name="short_desc" id="short_desc">
                              {{ $product->short_desc }}
                          </textarea>
                          <font style="color: red">{{ ($errors->has('short_desc')) ? ($errors->first('short_desc')) : '' }}</font>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="long_desc" class="col-sm-2 col-form-label">Long Description</label>
                      <div class="col-sm-8">
                          <textarea class="textarea" rows="2" name="long_desc" id="long_desc">
                              {{ $product->long_desc }}
                          </textarea>
                          <font style="color: red">{{ ($errors->has('long_desc')) ? ($errors->first('long_desc')) : '' }}</font>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="price" class="col-sm-2 col-form-label">Product Price</label>
                      <div class="col-sm-5">
                          <input type="text" name="price" value="{{ $product->price }}" class="form-control" id="price">
                          <font style="color: red">{{ ($errors->has('price')) ? ($errors->first('price')) : '' }}</font>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="category_id" class="col-sm-2 col-form-label">Category</label>
                      <div class="col-sm-5">
                          <select class="form-control" name="category_id" id="category_id">
                              <option value="">Select Category Option</option>
                              @foreach($categories as $category)
                              <option value="{{ $category->id }}" {{ ($category->id == $product->category_id) ? 'selected' : '' }}>{{ $category->name }}</option>
                              @endforeach
                          </select>
                          <font style="color: red">{{ ($errors->has('category_id')) ? ($errors->first('category_id')) : '' }}</font>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="brand_id" class="col-sm-2 col-form-label">Brand</label>
                      <div class="col-sm-5">
                          <select class="form-control" name="brand_id" id="brand_id">
                              <option value="">Select Brand Option</option>
                              @foreach($brands as $brand)
                              <option value="{{ $brand->id }}" {{ ($brand->id == $product->brand_id) ? 'selected' : '' }}>{{ $brand->name }}</option>
                              @endforeach
                          </select>
                          <font style="color: red">{{ ($errors->has('brand_id')) ? ($errors->first('brand_id')) : '' }}</font>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="color_id" class="col-sm-2 col-form-label">Product Color</label>
                      <div class="col-sm-5">
                          <select class="form-control select2" name="color_id[]" multiple>
                              @foreach($colors as $color)
                              <option value="{{ $color->id }}" {{ (@in_array(['color_id' => $color->id], $color_array)) ? 'selected' : '' }}>{{ $color->name }}</option>
                              @endforeach
                          </select>
                          <font style="color: red">{{ ($errors->has('color_id')) ? ($errors->first('color_id')) : '' }}</font>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="size_id" class="col-sm-2 col-form-label">Product Size</label>
                      <div class="col-sm-5">
                          <select class="form-control select2" name="size_id[]" multiple>
                              @foreach($sizes as $size)
                              <option value="{{ $size->id }}" {{ (@in_array(['size_id' => $size->id], $size_array)) ? 'selected' : '' }}>{{ $size->name }}</option>
                              @endforeach
                          </select>
                          <font style="color: red">{{ ($errors->has('size_id')) ? ($errors->first('size_id')) : '' }}</font>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="image" class="col-sm-2 col-form-label">Upload Image</label>
                      <div class="col-sm-5">
                          <input type="file" name="image" class="form-control" id="image">
                          <font style="color: red">{{ ($errors->has('image')) ? ($errors->first('image')) : '' }}</font>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="sub_image" class="col-sm-2 col-form-label">Sub Image</label>
                      <div class="col-sm-5">
                          <input type="file" name="sub_image[]" class="form-control" multiple>
                      </div>
                      <div class="col-sm-3">
                          <img src="{{ asset('images/products/'.$product->image) }}" width="100" height="100" alt="">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="name" class="col-sm-2 col-form-label"></label>
                      <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Update change</button>
                        <button type="reset" class="btn btn-secondary"><i class="fas fa-times"></i> Clear</button>
                      </div>
                    </div>
                  </form>
                  
                  
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

<script type="text/javascript">
$(document).ready(function () {
  
  $('#myForm').validate({
    rules: {
      category_id: {
        required: true
      },
      brand_id: {
        required: true
      },
      name: {
        required: true
      },
      short_desc: {
        required: true
      },
      long_desc: {
        required: true
      },
      price: {
        required: true
      },
      image: {
        image: true
      },
      color_id: {
        required: true
      },
      size_id: {
        required: true
      }
    },
    messages: {
      category_id: {
        required: "Please enter a Category Name"
      },
      brand_id: {
        required: "Please enter a Brand Name"
      },
      name: {
        required: "Please enter a Product Name"
      },
      short_desc: {
        required: "Please enter a Product Short Descrition"
      },
      long_desc: {
        required: "Please enter a Product Long Description"
      },
      price: {
        required: "Please enter a Product Price"
      },
      image: {
        image: "Please enter a Valid Image",
      },
      color_id: {
        required: "Please enter a Product Color"
      },
      size_id: {
        required: "Please enter a Product Size"
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

