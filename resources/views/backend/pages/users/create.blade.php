@extends('backend.layouts.admin_master')
@section('admin_content')


  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User</li>
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
                <h3 class="card-title"><i class="fas fa-user-plus"></i> Add New User</h3>
                <a href="{{ route('user.index') }}" class="btn btn-success btn-sm float-right"><i class="fas fa-list"></i> User List</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ route('user.store') }}" method="post" id="myForm">
                  @csrf

                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="role">User Role</label>
                      <select name="role" id="role" class="form-control">
                        <option value="">Select Role</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                      </select>
                      <font style="color: red">{{ ($errors->has('role')) ? ($errors->first('role')) : '' }}</font>
                    </div>

                    <div class="form-group col-md-4">
                      <label for="name">Name</label>
                      <input type="text" name="name" id="name" class="form-control">
                      <font style="color: red">{{ ($errors->has('name')) ? ($errors->first('name')) : '' }}</font>
                    </div>

                    <div class="form-group col-md-4">
                      <label for="email">Email</label>
                      <input type="email" name="email" id="email" class="form-control">
                      <font style="color: red">{{ ($errors->has('email')) ? ($errors->first('email')) : '' }}</font>
                    </div>

                    <div class="form-group col-md-4">
                      <label for="password">Password</label>
                      <input type="password" name="password" id="password" class="form-control">
                      <font style="color: red">{{ ($errors->has('password')) ? ($errors->first('password')) : '' }}</font>
                    </div>

                    <div class="form-group col-md-4">
                      <label for="password">Confirm Password</label>
                      <input type="password" name="password2" class="form-control">
                      
                    </div>

                    <div class="form-group col-md-6">
                      
                      <input type="submit" value="Save change" class="btn btn-success">
                      
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
      name: {
        required: true
      },
      email: {
        required: true,
        email: true,
      },
      role: {
        required: true
      },
      password: {
        required: true
      },
      password2: {
        required: true,
        equalTo: '#password',
      }
    },
    messages: {
      name: {
        required: "Please enter a User Name"
      },
      email: {
        required: "Please enter a email address",
        email: "Please enter a vaild email address"
      },
      role: {
        required: "Please enter a User Role"
      },
      password: {
        required: "Please provide a User Password"
      },
      password2: {
        required: "Please provide a Confirm Password",
        equalTo: "Confirm Password Does Not Match"
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
