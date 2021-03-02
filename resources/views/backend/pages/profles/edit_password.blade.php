@extends('backend.layouts.admin_master')
@section('admin_content')


	<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Password</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Password</li>
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
                <h3 class="card-title"><i class="fas fa-key"></i> Update Password</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ route('user.update.password') }}" method="post" id="myForm">
                  @csrf

                  <div class="form-row">
                    

                    <div class="form-group col-md-4">
                      <label for="current_password">Current Password</label>
                      <input type="password" name="current_password" id="current_password" class="form-control">
                      <font style="color: red">{{ ($errors->has('current_password')) ? ($errors->first('current_password')) : '' }}</font>
                    </div>

                    <div class="form-group col-md-4">
                      <label for="new_password">New Password</label>
                      <input type="password" name="new_password" id="new_password" class="form-control">
                      <font style="color: red">{{ ($errors->has('new_password')) ? ($errors->first('new_password')) : '' }}</font>
                    </div>

                    <div class="form-group col-md-4">
                      <label for="again_new_password">Again New Password</label>
                      <input type="password" name="again_new_password" class="form-control">
                      
                    </div>

                    <div class="form-group col-md-6">
                      
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

      current_password: {
        required: true
      },
      new_password: {
        required: true,
        minlength: 8
      },
      again_new_password: {
        required: true,
        equalTo: '#new_password'
      }
    },

    messages: {
      
      current_password: {
        required: "Please Enter a Current Password"
      },
      new_password: {
        required: "Please Enter a New Password",
        minlength: "Password will be minimum 8 characters"
      },
      again_new_password: {
        required: "Please Enter a Again New Password",
        equalTo: "Again New Password Does Not Match!!"
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