@extends('layouts.admin_layout.admin_layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Products</h1>
                        @if(Session::has('error_message'))
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
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Bam!</strong> {{ Session::get('success_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Products</li>
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
                                <h3 class="card-title" style="margin-top: 5px;">Products Data</h3>
                                <a href="{{ url('/admin/add-edit-product/') }}"><button type="button" class="btn btn-primary btn-sm" style="float: right; display: inline-block;">Add Product</button></a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="products" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Product Name</th>
                                            <th>Product Code</th>
                                            <th>Product Color</th>
                                            <th>Product Section</th>
                                            <th>Product Category</th>
                                            <th>Product Image</th>
                                            <th>Is Featured</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $product)
                                            <tr>
                                                <td>{{ $product->id }}</td>
                                                <td>{{ ucwords($product->product_name) }}</td>
                                                <td>{{ ucwords($product->product_code) }}</td>
                                                <td>{{ ucwords($product->product_color) }}</td>
                                                <td>{{ ucwords($product->section->name) }}</td>
                                                <td>{{ ucwords($product->category->category_name) }}</td>
                                                <td>
                                                    @if(!empty($product->main_image) && file_exists('images/product_images/small/' . $product->main_image))
                                                        <img src="{{ asset('/images/product_images/small/' . $product->main_image) }}" alt="{{ $product->main_image }}" height="100px" width="100px">
                                                    @else
                                                        <img src="{{ asset('/images/product_images/thumbs/default.jpg') }}" alt="No Image Set" height="100px" width="100px">
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($product->is_featured == "Yes")
                                                        <button type="button" class="btn btn-success btn-sm" style="pointer-events: none;">Yes</button>
                                                    @else
                                                        <button type="button" class="btn btn-danger btn-sm" style="pointer-events: none;">No</button>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($product->status == 1)
                                                        <a class="updateProductStatus" id="product-{{ $product->id }}" product_id="{{ $product->id }}" href="javascript:void(0)"><button type="button" class="btn btn-success btn-sm" style="pointer-events: none;">Active</button><span id="ajaxStatus-{{ $product->id }}" class="ajaxStatus-{{ $product->id }}"></span></a>
                                                    @else
                                                        <a class="updateProductStatus" id="product-{{ $product->id }}" product_id="{{ $product->id }}" href="javascript:void(0)"><button type="button" class="btn btn-danger btn-sm" style="pointer-events: none;">Inactive</button><span id="ajaxStatus-{{ $product->id }}" class="ajaxStatus-{{ $product->id }}"></span></a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ url('/admin/add-edit-product/' . $product->id) }}"><button type="button" class="btn btn-warning btn-sm">Edit</button></a>
                                                    <a href="javascript:void(0)" class="confirmDelete" record="Product" recordid="{{ $product->id }}" dataName="product" dataId="{{ $product->id }}"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Product Name</th>
                                            <th>Product Code</th>
                                            <th>Product Color</th>
                                            <th>Product Section</th>
                                            <th>Product Category</th>
                                            <th>Product Image</th>
                                            <th>Is Featured</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
