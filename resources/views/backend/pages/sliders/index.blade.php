@extends('backend.layouts.admin_master')
@section('admin_content')


<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Manage Slider</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Slider</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-list"></i> View Slider List</h3>
                        <a href="#addModal" class="btn btn-success btn-sm float-right" data-toggle="modal"><i class="fas fa-plus-square"></i> Add Slider</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <!-- Add Modal -->
                        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus-square"></i> Add New Slider</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                  <form action="{{ route('admin.slider.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div class="form-group">
                                      <label for="short_title">Short Title</label>
                                      <input type="text" name="short_title" class="form-control" id="short_title" aria-describedby="emailHelp">
                                      <font style="color: red">{{ ($errors->has('short_title')) ? ($errors->first('short_title')) : '' }}</font>
                                    </div>
                                    
                                    <div class="form-group">
                                      <label for="long_title">Long Title</label>
                                      <input type="text" name="long_title" class="form-control" id="long_title">
                                      <font style="color: red">{{ ($errors->has('long_title')) ? ($errors->first('long_title')) : '' }}</font>
                                    </div>
                                    
                                    <div class="form-group">
                                      <label for="image">Upload Image</label>
                                      <input type="file" name="image" class="form-control" id="image">
                                      <font style="color: red">{{ ($errors->has('image')) ? ($errors->first('image')) : '' }}</font>
                                    </div>
                                    
                                
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                              </div>
                            </form>
                            </div>
                          </div>
                        </div>
                        
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Image</th>
                                    <th>Short Title</th>
                                    <th>Long Title</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sliders as $slider)
                                <tr class="{{ $slider->id }}">
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td><img src="{{ asset('images/sliders/'.$slider->image) }}" width="50" height="50" alt=""></td>
                                    <td>{{ $slider->short_title }}</td>
                                    <td>{{ $slider->long_title }}</td>
                                    <td><span class="badge badge-success">Published</span></td>
                                    <td>
                                        <a href="#editModal{{ $slider->id }}" title="Edit" class="btn btn-success btn-sm" data-toggle="modal"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('admin.slider.delete') }}" id="delete" data-token="{{csrf_token()}}" data-id="{{$slider->id}}" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                        
                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editModal{{ $slider->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Update Slider</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                  <form action="{{ route('admin.slider.update', $slider->id) }}" method="post" enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="form-group">
                                                      <label for="short_title">Short Title</label>
                                                      <input type="text" name="short_title" value="{{ $slider->short_title }}" class="form-control" id="short_title" aria-describedby="emailHelp">
                                                      <font style="color: red">{{ ($errors->has('short_title')) ? ($errors->first('short_title')) : '' }}</font>
                                                    </div>

                                                    <div class="form-group">
                                                      <label for="long_title">Long Title</label>
                                                      <input type="text" name="long_title" value="{{ $slider->long_title }}" class="form-control" id="long_title">
                                                      <font style="color: red">{{ ($errors->has('long_title')) ? ($errors->first('long_title')) : '' }}</font>
                                                    </div>

                                                    <div class="form-group">
                                                      <label for="image">Upload Image</label>
                                                      <input type="file" name="image" class="form-control" id="image">
                                                      <img src="{{ asset('images/sliders/'.$slider->image) }}" class="mt-2" width="80" height="80" alt="">
                                                      <font style="color: red">{{ ($errors->has('image')) ? ($errors->first('image')) : '' }}</font>
                                                    </div>


                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update changes</button>
                                              </div>
                                            </form>
                                            </div>
                                          </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                            
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
<!-- /.content -->



@endsection

@section('admin_script')
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
@endsection