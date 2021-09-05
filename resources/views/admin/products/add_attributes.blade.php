@extends('layouts.admin_layout.admin_layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Product Attributes</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/admin/view-products') }}">Product</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/admin/view-products') }}">{{ ucwords($productData->product_name) }}</a></li>
                            <li class="breadcrumb-item active">{{ ucwords($title) }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        {{-- Add Category --}}
        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title" style="margin-top: 9px;">{{ ucwords($productData->product_name) }} - {{ ucwords($title) }}</h3>
                        @if(Session::has('error_message'))
                            <br>
                            <br>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{-- <strong>Oopsy!</strong> Something is wrong. Please try again. --}}
                                <strong>Oopsy!</strong> {{ Session::get('error_message') }}.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if(Session::has('success_message'))
                            <br>
                            <br>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Bam!</strong> {{ Session::get('success_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if($errors->any())
                            <br>
                            <br>
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <a href="{{ url('/admin/view-products') }}"><button type="button" class="btn btn-primary">View Products</button></a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                        <section class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-3">
                                        <!-- Profile Image -->
                                        <div class="card card-primary card-outline">
                                            <div class="card-body box-profile">
                                                <div class="text-center">
                                                    @if(!empty($productData->main_image))
                                                        {{-- <img class="profile-user-img img-fluid img-circle" src="{{ asset('/images/product_images/medium/' . $productData->main_image) }}"  alt="Image - {{ $productData->product_name }}"> --}}
                                                        <img class="img-fluid" src="{{ asset('/images/product_images/medium/' . $productData->main_image) }}"  alt="Image - {{ $productData->product_name }}">
                                                    @else
                                                        <img class="img-fluid" src="{{ asset('/images/product_images/medium/default.jpg') }}"  alt="No Image - Default">
                                                    @endif
                                                </div>
                                                <h3 class="profile-username text-center">{{ $productData->product_name }}</h3>
                                                <p class="text-muted text-center">{{ $productData->description }}</p>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                        <!-- /.col -->
                                    <div class="col-md-9">
                                        <form action="{{ url('/admin/add-attributes/' . $productData->id) }}" method="post" enctype="multipart/form-data" id="addProductAttributesForm" name="addProductAttributesForm">
                                            @csrf
                                            <div class="card">
                                                <div class="card-header p-2">
                                                    <ul class="nav nav-pills">
                                                        <li class="nav-item"><a class="active nav-link" href="#attributes" data-toggle="tab">Attributes</a></li>
                                                    </ul>
                                                </div><!-- /.card-header -->
                                                <div class="card-body">
                                                    <div class="tab-content">
                                                        <div class="active tab-pane" id="attributes">
                                                            <div class="form-group row">
                                                                <label for="inputName" class="col-sm-2 col-form-label">Product Name</label>
                                                                <div class="col-sm-10 col-form-label">
                                                                    {{ $productData->product_name }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="inputEmail" class="col-sm-2 col-form-label">Product Code</label>
                                                                <div class="col-sm-10 col-form-label">
                                                                    {{ $productData->product_code }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="inputName2" class="col-sm-2 col-form-label">Product Color</label>
                                                                <div class="col-sm-10 col-form-label">
                                                                    {{ $productData->product_color }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="inputExperience" class="col-sm-2 col-form-label">Product Category</label>
                                                                <div class="col-sm-10 col-form-label">
                                                                    {{ $categoryData->category_name }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="inputExperience" class="col-sm-2 col-form-label">Product Section</label>
                                                                <div class="col-sm-10 col-form-label">
                                                                    {{ $sectionData->name }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="inputExperience" class="col-sm-2 col-form-label">Add New Attribute</label>
                                                            </div>
                                                            <div class="field_wrapper">
                                                                <div>
                                                                    <input type="text" name="sku[]" value="" id="sku" placeholder="SKU" required/>&nbsp;&nbsp;
                                                                    <input type="text" name="size[]" value="" id="size" placeholder="Size" required/>&nbsp;&nbsp;
                                                                    <input type="number" name="price[]" value="" id="price" placeholder="Price" required/>&nbsp;&nbsp;
                                                                    <input type="number" name="stock[]" value="" id="stock" placeholder="Stock" required/>&nbsp;&nbsp;
                                                                    <a href="javascript:void(0);" class="add_button" title="Add field"><img src="{{ asset('images/admin_images/add-icon.png') }}"/></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- /.tab-pane -->
                                                    </div>
                                                    <!-- /.tab-content -->
                                                </div><!-- /.card-body -->
                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-primary" style="float: right; display: inline-block; margin-left: 15px;">Submit</button>
                                                    <button type="button" class="btn btn-danger" style="float: right; display: inline-block;" onClick="window.location.reload()">Reset</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="card card-primary card-outline">
                                            <div class="card-body box-profile">
                                                <div class="form-group row">
                                                    <label for="inputName2" class="col-sm-6 col-form-label">Product Discount</label>
                                                    <div class="col-sm-6 col-form-label">
                                                        {{ number_format($productData->product_discount, 2, '.', '') }} %
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName2" class="col-sm-6 col-form-label">Product Weight</label>
                                                    <div class="col-sm-6 col-form-label">
                                                        {{ number_format($productData->product_weight, 2, '.', '') }} gms
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName2" class="col-sm-6 col-form-label">Fabric</label>
                                                    <div class="col-sm-6 col-form-label">
                                                        {{ $productData->fabric }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName2" class="col-sm-6 col-form-label">Pattern</label>
                                                    <div class="col-sm-6 col-form-label">
                                                        {{ $productData->pattern }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName2" class="col-sm-6 col-form-label">Sleeve</label>
                                                    <div class="col-sm-6 col-form-label">
                                                        {{ $productData->sleeve }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName2" class="col-sm-6 col-form-label">Fit</label>
                                                    <div class="col-sm-6 col-form-label">
                                                        {{ $productData->fit }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName2" class="col-sm-6 col-form-label">Occasion</label>
                                                    <div class="col-sm-6 col-form-label">
                                                        {{ $productData->occasion }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <form action="{{ url('/admin/update-attributes/' . $productData->id) }}" method="post" enctype="multipart/form-data" id="updateProductAttributesForm" name="updateProductAttributesForm">
                                            @csrf
                                            <!-- /.card -->
                                            <!-- About Me Box -->
                                            <div class="card card-primary">
                                                <div class="card-header">
                                                    <h3 class="card-title">Existing Attributes</h3>
                                                </div>
                                                <div class="card-body">
                                                    <table id="products" class="table table-bordered table-hover table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th>SKU</th>
                                                            <th>Size</th>
                                                            <th>Price</th>
                                                            <th>Stock</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($productData->attributes as $attribute)
                                                            <tr>
                                                                <td><input type="hidden" name="sku[]" value="{{ $attribute->sku }}" id="sku"/>{{ $attribute->sku }}</td>
                                                                <td>{{ $attribute->size }}</td>
                                                                <td><input type="number" name="price[]" value="{{ number_format($attribute->price, 2, '.', '') }}" id="price" placeholder="Price" required/></td>
                                                                <td><input type="number" name="stock[]" value="{{ $attribute->stock }}" id="stock" placeholder="Stock" required/></td>
                                                                <td>
                                                                    @if($attribute->status == 1)
                                                                        <button type="button" class="btn btn-success btn-sm" style="pointer-events: none;">Active</button>
                                                                    @else
                                                                        <button type="button" class="btn btn-danger btn-sm" style="pointer-events: none;">Inactive</button>
                                                                    @endif
                                                                </td>
                                                                <td></td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                        <tr>
                                                            <th>SKU</th>
                                                            <th>Size</th>
                                                            <th>Price</th>
                                                            <th>Stock</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-primary" style="float: right; display: inline-block; margin-left: 15px;">Submit</button>
                                                    <button type="button" class="btn btn-danger" style="float: right; display: inline-block;" onClick="window.location.reload()">Reset</button>
                                                </div>
                                            </div>
                                            <!-- /.card -->
                                        </form>
                                    </div>
                                    <!-- /.row -->
                                </div><!-- /.container-fluid -->
                            </div>
                        </section>
                        <!-- /.card-body -->
                    </div>
                <!-- /.card -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
