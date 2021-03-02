@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('public/backend') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">FurnishFurniture</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ (!empty($user->image)) ? url('images/users/'.$user->image) : url('images/default/no.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('home') }}" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open">
                    <a href="{{ route('home') }}" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                </li>

                @if(Auth::user()->role == 'admin')
                <li class="nav-item has-treeview {{($prefix=='/users')?'menu-open':''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Manage User
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.index') }}" class="nav-link {{($route=='user.index')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View User</p>
                            </a>
                        </li>
                        

                    </ul>
                </li>
                @endif
                <li class="nav-item has-treeview {{($prefix=='/profiles')?'menu-open':''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            Manage Profile
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.profiles') }}" class="nav-link {{($route=='user.profiles')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.change.password') }}" class="nav-link {{($route=='user.change.password')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Change Password</p>
                            </a>
                        </li>


                    </ul>
                </li>
                
                <li class="nav-item has-treeview {{($prefix=='/customers')?'menu-open':''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cut"></i>
                        <p>
                            Manage Customer
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('customer.show') }}" class="nav-link {{($route=='customer.show')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Customer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customer.draft.show') }}" class="nav-link {{($route=='customer.draft.show')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Draft Customer</p>
                            </a>
                        </li>


                    </ul>
                </li>
                
                <li class="nav-item has-treeview {{($prefix=='/categories')?'menu-open':''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Category
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.category.create') }}" class="nav-link {{($route=='admin.category.create')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add  Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.categories') }}" class="nav-link {{($route=='admin.categories')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Category</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item has-treeview {{($prefix=='/brands')?'menu-open':''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Brand
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.brand.create') }}" class="nav-link {{($route=='admin.brand.create')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Brand</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.brands') }}" class="nav-link {{($route=='admin.brands')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Brand</p>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item has-treeview {{($prefix=='/colors')?'menu-open':''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>
                            Color
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.color.create') }}" class="nav-link {{($route=='admin.color.create')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Color</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.colors') }}" class="nav-link {{($route=='admin.colors')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Color</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item has-treeview {{($prefix=='/sizes')?'menu-open':''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Size
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.size.create') }}" class="nav-link {{($route=='admin.size.create')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Size</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.sizes') }}" class="nav-link {{($route=='admin.sizes')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Size</p>
                            </a>
                        </li>


                    </ul>
                </li>
                <li class="nav-item has-treeview {{($prefix=='/products')?'menu-open':''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            Product
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.product.create') }}" class="nav-link {{($route=='admin.product.create')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Product</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.products') }}" class="nav-link {{($route=='admin.products')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Product</p>
                            </a>
                        </li>


                    </ul>
                </li>
                
                <li class="nav-item has-treeview {{($prefix=='/sliders')?'menu-open':''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-minus-square"></i>
                        <p>
                            Manage Slider
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.sliders') }}" class="nav-link {{($route=='admin.sliders')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Slider</p>
                            </a>
                        </li>

                    </ul>
                </li>
                
                <li class="nav-item has-treeview {{($prefix=='/orders')?'menu-open':''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                           Order
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.order.pending') }}" class="nav-link {{($route=='admin.order.pending')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pending View</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{ route('admin.order.approved') }}" class="nav-link {{($route=='admin.order.approved')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Approved View</p>
                            </a>
                        </li>

                    </ul>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>