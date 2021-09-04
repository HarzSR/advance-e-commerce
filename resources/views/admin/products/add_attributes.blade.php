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
                <form action="{{ url('/admin/add-attributes/' . $productData->id) }}" method="post" enctype="multipart/form-data" id="addProductAttributesForm" name="addProductAttributesForm">
                    @csrf
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
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Product Name : </label>&nbsp;{{ $productData->product_name }}
                                    </div>
                                    <div class="form-group">
                                        <label>Product Code : </label>&nbsp;{{ $productData->product_code }}
                                    </div>
                                    <div class="form-group">
                                        <label>Product Color : </label>&nbsp;{{ $productData->product_color }}
                                    </div>
                                    <div class="form-group">
                                        <label>Product Category : </label>&nbsp;{{ $productData->category_id }}
                                    </div>
                                    <div class="form-group">
                                        <label>Product Section : </label>&nbsp;{{ $productData->section_id }}
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="form-check">
                                <button type="submit" class="btn btn-primary" style="float: right; display: inline-block; margin-left: 15px;">Submit</button>
                                <button type="button" class="btn btn-danger" style="float: right; display: inline-block;" onClick="window.location.reload()">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- /.card -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
