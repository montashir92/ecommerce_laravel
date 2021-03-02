@extends('backend.layouts.admin_master')
@section('admin_content')


	<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
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
                <h3 class="card-title"><i class="fas fa-edit"></i> Update Profile</h3>
                <a href="{{ route('user.profiles') }}" class="btn btn-success btn-sm float-right"><i class="fas fa-id-card"></i> Your Profile</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ route('user.profile.update') }}" method="post" id="myForm" enctype="multipart/form-data">
                  @csrf

                  <div class="form-row">

                    <div class="form-group col-md-4">
                      <label for="name">Name</label>
                      <input type="text" name="name" id="name" value="{{ $userdata->name }}" class="form-control">
                      <font style="color: red">{{ ($errors->has('name')) ? ($errors->first('name')) : '' }}</font>
                    </div>

                    <div class="form-group col-md-4">
                      <label for="email">Email</label>
                      <input type="email" name="email" id="email" value="{{ $userdata->email }}" class="form-control">
                      <font style="color: red">{{ ($errors->has('email')) ? ($errors->first('email')) : '' }}</font>
                    </div>

                    <div class="form-group col-md-4">
                      <label for="mobile">Mobile No</label>
                      <input type="text" name="mobile" id="mobile" value="{{ $userdata->mobile }}" class="form-control">
                      <font style="color: red">{{ ($errors->has('mobile')) ? ($errors->first('mobile')) : '' }}</font>
                    </div>

                    <div class="form-group col-md-4">
                      <label for="address">Address</label>
                      <input type="text" name="address" id="address" value="{{ $userdata->address }}" class="form-control">
                      <font style="color: red">{{ ($errors->has('address')) ? ($errors->first('address')) : '' }}</font>
                    </div>


                    <div class="form-group col-md-4">
                      <label for="gender">Gender</label>
                      <select name="gender" id="gender" class="form-control">
                        <option value="">Select your Gender</option>
                        <option value="Male" {{ ($userdata->gender == 'Male') ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ ($userdata->gender == 'Female') ? 'selected' : '' }}>Female</option>
                      </select>
                      <font style="color: red">{{ ($errors->has('gender')) ? ($errors->first('gender')) : '' }}</font>
                    </div>

                    <div class="form-group col-md-4">
                      <label for="image">Upload Image</label>
                      <input type="file" name="image" id="image" class="form-control">

                      <font style="color: red">{{ ($errors->has('image')) ? ($errors->first('image')) : '' }}</font>
                    </div>

                    <div class="form-group col-md-4">
                      <img src="{{ (!empty($userdata->image)) ? asset('images/users/'.$userdata->image) : asset('images/default/no.jpg') }}" id="showImage" style="width: 170px; height: 160px; border: 1px solid #999; padding: 2px;" alt="">
                    </div>

                    
                    <div class="form-group col-md-12">
                      
                      <input type="submit" value="Update change" class="btn btn-success">
                      
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

<script>
$(function () {
  
  $('#myForm').validate({
    rules: {
      name: {
        required: true
      },
      email: {
        required: true,
        email: true
      },
      mobile: {
        required: true
      },
      address: {
        required: true
      },
      gender: {
        required: true
      },
      image: {
        image: true
      }
    },

    messages: {
      name: {
        required: "Please Provide a User Name"
      },
      
      email: {
        required: "Please Provide a User Email",
        email: "Please Provide Valid Email"
      },
      mobile: {
        required: "Please Provide a User Mobile"
      },
      address: {
        required: "Please Provide a User Address"
      },
      gender: {
        required: "Please Provide a User Gender"
      },
      image: {
        image: "Pleasse Provide A Valid Image"
      },

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


<script>
  $(document).ready(function(){
    $("#image").change(function(e){
      var reader = new FileReader();
      reader.onload = function(e){
        $('#showImage').attr('src',e.target.result);
      }
      reader.readAsDataURL(e.target.files['0']);
    });
  });
</script>



@endsection