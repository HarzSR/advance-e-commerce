@extends('layouts.admin_layout.admin_layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Products</h1>
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
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">{{ ucwords($title) }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        @if($title == "Edit Product")
            {{-- Edit Category --}}
            <section class="content">
                <div class="container-fluid">

                </div>
                <!-- /.container-fluid -->
            </section>
        @elseif($title == "Add Product")
            {{-- Add Category --}}
            <section class="content">
                <div class="container-fluid">
                    <!-- SELECT2 EXAMPLE -->
                    <form action="{{ url('/admin/add-edit-product') }}" method="post" enctype="multipart/form-data" id="productForm" name="productForm">
                        @csrf
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title" style="margin-top: 9px;">{{ ucwords($title) }}</h3>
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
                                    <a href="{{ url('/admin/view-categories') }}"><button type="button" class="btn btn-primary">View Products</button></a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select Category</label><span style="color: red;"> *</span>
                                            <select class="form-control select2" id="category_id" name="category_id" style="width: 100%;">
                                                <option value="">Select</option>
                                                @foreach($sectionArray as $section)
                                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product Name</label><span style="color: red;"> *</span>
                                            <input type="text" class="form-control" id="product_name" name="product_name" value="{{ old('product_name') }}" placeholder="Enter Product Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product Code</label><span style="color: red;"> *</span>
                                            <input type="text" class="form-control" id="product_code" name="product_code" value="{{ old('product_code') }}" placeholder="Enter Product Code">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product Color</label><span style="color: red;"> *</span>
                                            <input type="text" class="form-control" id="product_color" name="product_color" value="{{ old('product_color') }}" placeholder="Enter Product Color">
                                        </div>
                                        <div class="form-group">
                                            <label for="image">Product Image</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="main_image" name="main_image">
                                                    <label class="custom-file-label" for="image">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Select Fabric</label><span style="color: red;"> *</span>
                                            <select class="form-control select2" id="fabric_id" name="fabric_id" style="width: 100%;">
                                                <option value="">Select</option>
                                                @foreach($fabricArray as $fabric)
                                                    <option value="{{ $fabric->id }}">{{ $fabric->description }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Select Sleeve</label><span style="color: red;"> *</span>
                                            <select class="form-control select2" id="sleeve_id" name="sleeve_id" style="width: 100%;">
                                                <option value="">Select</option>
                                                @foreach($sleeveArray as $sleeve)
                                                    <option value="{{ $sleeve->id }}">{{ $sleeve->description }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label><span style="color: red;"> *</span>
                                            <textarea class="form-control" id="category_description" name="category_description" rows="3" placeholder="Enter Category Description ...">{{ old('category_description') }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Meta Description</label>
                                            <textarea class="form-control" id="meta_description" name="meta_description" rows="3" placeholder="Enter Meta Description ...">{{ old('meta_description') }}</textarea>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select Section</label><span style="color: red;"> *</span>
                                            <select class="form-control select2" id="section_id" name="section_id" style="width: 100%;">
                                                <option value="">Select</option>
                                                @foreach($categoryArray as $category)
                                                    @if($category->parent_id != 0)
                                                        <option value="{{ $category->id }}">-- {{ $category->category_name }}</option>
                                                    @else
                                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product Weight</label><span style="color: red;"> *</span>
                                            <input type="text" class="form-control" id="product_weight" name="product_weight" value="{{ old('product_weight') }}" placeholder="Enter Product Weight">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product Price</label><span style="color: red;"> *</span>
                                            <input type="text" class="form-control" id="product_price" name="product_price" value="{{ old('product_price') }}" placeholder="Enter Product Price">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product Discount</label><span style="color: red;"> *</span>
                                            <input type="text" class="form-control" id="product_discount" value="{{ old('product_discount') }}" name="product_discount" placeholder="Enter Product Discount">
                                        </div>
                                        <div class="form-group">
                                            <label for="image">Product Video</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="product_video" name="product_video">
                                                    <label class="custom-file-label" for="image">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Select Pattern</label><span style="color: red;"> *</span>
                                            <select class="form-control select2" id="pattern_id" name="pattern_id" style="width: 100%;">
                                                <option value="">Select</option>
                                                @foreach($patternArray as $pattern)
                                                    <option value="{{ $pattern->id }}">{{ $pattern->description }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Select Fit</label><span style="color: red;"> *</span>
                                            <select class="form-control select2" id="fit_id" name="fit_id" style="width: 100%;">
                                                <option value="">Select</option>
                                                @foreach($fitArray as $fit)
                                                    <option value="{{ $fit->id }}">{{ $fit->description }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Select Occasion</label><span style="color: red;"> *</span>
                                            <select class="form-control select2" id="occasion" name="occasion" style="width: 100%;">
                                                <option value="">Select</option>
                                                @foreach($occasionArray as $occasion)
                                                    <option value="{{ $occasion->id }}">{{ $occasion->description }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Meta Title</label>
                                            <textarea class="form-control" id="meta_title" name="meta_title" rows="3" placeholder="Enter Meta Title ...">{{ old('meta_title') }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Meta Keywords</label>
                                            <textarea class="form-control" id="meta_keywords" name="meta_keywords" rows="3" placeholder="Enter Meta Keywords ...">{{ old('meta_keywords') }}</textarea>
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
                                    <input type="checkbox" class="form-check-input" id="status" name="status" @if(!empty(old('status'))) checked @endif value="1" style="margin-top: 15px;">
                                    <label class="form-check-label" for="status" style="margin-top: 9px;">Status</label>
                                    <button type="submit" class="btn btn-primary" style="float: right; display: inline-block">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- /.card -->
                </div>
                <!-- /.container-fluid -->
            </section>
        @endif
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
