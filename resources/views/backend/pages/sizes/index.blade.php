@extends('backend.layouts.admin_master')
@section('admin_content')


<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Manage Size</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Size</li>
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
                        <h3 class="card-title"><i class="fas fa-list"></i> View Size List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sizes as $size)
                                @php
                                $size_count = App\Models\ProductSize::where('size_id', $size->id)->count();
                                @endphp
                                <tr class="{{ $size->id }}">
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $size->name }}</td>
                                    <td><span class="badge badge-success">Published</span></td>
                                    <td>
                                        
                                        <a href="{{ route('admin.size.edit', $size->id) }}" title="Edit" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                        @if($size_count < 1)
                                        <a href="{{ route('admin.size.delete') }}" id="delete" data-token="{{csrf_token()}}" data-id="{{$size->id}}" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                        @else
                                        <span class="badge badge-warning">Use</span>
                                        @endif
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