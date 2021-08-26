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
                    <form action="{{ url('/admin/add-edit-product/' . $productDetail->id) }}" method="post" enctype="multipart/form-data" id="editProductForm" name="editProductForm">
                        @csrf
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title" style="margin-top: 9px;">{{ ucwords($title) }}</h3>
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
                                            <label>Select Category</label><span style="color: red;"> *</span>
                                            <select class="form-control select2" id="category_id" name="category_id" style="width: 100%;">
                                                <option value="">Select</option>
                                                @foreach($categories as $section)
                                                    <optgroup label="{{ $section->name }}"></optgroup>
                                                    @foreach($section->categories as $category)
                                                        <option value="{{ $category->id }}" @if(!empty(old('category_id')) && $category->id == old('category_id')) selected @elseif($category->id == $productDetail->id) selected @endif>&nbsp;&nbsp;&nbsp;&nbsp; {{ $category->category_name }} - {{ $section->name }}</option>
                                                        @foreach($category->subcategories as $subcategory)
                                                            <option value="{{ $subcategory->id }}" @if(!empty(old('category_id')) && $subcategory->id == old('category_id')) selected @elseif($subcategory->id == $productDetail->id) selected @endif>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $subcategory->category_name }} - {{ $section->name }}</option>
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product Name</label><span style="color: red;"> *</span>
                                            <input type="text" class="form-control" id="product_name" name="product_name" value="@if(!empty(old('product_name'))) {{ old('product_name') }} @else {{ $productDetail->product_name }} @endif" placeholder="Enter Product Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product Code</label><span style="color: red;"> *</span>
                                            <input type="text" class="form-control" id="product_code" name="product_code" value="@if(!empty(old('product_code'))) {{ old('product_code') }} @else {{ $productDetail->product_code }} @endif" placeholder="Enter Product Code">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product Color</label><span style="color: red;"> *</span>
                                            <input type="text" class="form-control" id="product_color" name="product_color" value="@if(!empty(old('product_color'))) {{ old('product_color') }} @else {{ $productDetail->product_color }} @endif" placeholder="Enter Product Color">
                                        </div>
                                        <div class="form-group">
                                            <label for="image">Product Image</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    @if(!empty($productDetail->main_image))
                                                        <input type="hidden" id="current_image" name="current_image" value="{{ $productDetail->main_image }}">
                                                    @endif
                                                    <input type="file" class="custom-file-input" id="main_image" name="main_image">
                                                    <label class="custom-file-label" for="image" @if(!empty($productDetail->main_image)) style="margin-right: 210px;" @endif>Choose file</label>
                                                    @if(!empty($productDetail->main_image))
                                                        <img src="{{ asset('/images/product_images/small/' . $productDetail->main_image) }}" alt="{{ $productDetail->main_image }}" height="120px" width="120px">&nbsp;&nbsp;&nbsp;
                                                        <a href="{{ url('/admin/delete-product-image/' . $productDetail->id) }}"><button type="button" class="btn btn-danger" style="float: right; display: inline-block;">Delete</button></a>
                                                    @endif
                                                </div>
                                            </div>Please use a visible clear image.
                                        </div>
                                        <div class="form-group">
                                            <label>Select Fabric</label><span style="color: red;"> *</span>
                                            <select class="form-control select2" id="fabric_id" name="fabric_id" style="width: 100%;">
                                                <option value="">Select</option>
                                                @foreach($fabricArray as $fabric)
                                                    <option value="{{ $fabric->description }}" @if(!empty(old('fabric_id')) && $fabric->description == old('fabric_id')) selected @elseif($fabric->description == $productDetail->fabric) selected @endif>{{ $fabric->description }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Select Sleeve</label><span style="color: red;"> *</span>
                                            <select class="form-control select2" id="sleeve_id" name="sleeve_id" style="width: 100%;">
                                                <option value="">Select</option>
                                                @foreach($sleeveArray as $sleeve)
                                                    <option value="{{ $sleeve->description }}" @if(!empty(old('sleeve_id')) && $sleeve->description == old('sleeve_id')) selected @elseif($sleeve->description == $productDetail->sleeve) selected @endif>{{ $sleeve->description }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Wash Care</label><span style="color: red;"> *</span>
                                            <textarea class="form-control" id="wash_care" name="wash_care" rows="1" placeholder="Enter Wash Care ...">@if(!empty(old('wash_care'))) {{ old('wash_care') }} @else {{ $productDetail->wash_care }} @endif</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label><span style="color: red;"> *</span>
                                            <textarea class="form-control" id="category_description" name="category_description" rows="3" placeholder="Enter Category Description ...">@if(!empty(old('category_description'))) {{ old('category_description') }} @else {{ $productDetail->description }} @endif</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Meta Description</label>
                                            <textarea class="form-control" id="meta_description" name="meta_description" rows="3" placeholder="Enter Meta Description ...">@if(!empty(old('meta_description'))) {{ old('meta_description') }} @else {{ $productDetail->meta_description }} @endif</textarea>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select Occasion</label><span style="color: red;"> *</span>
                                            <select class="form-control select2" id="occasion" name="occasion" style="width: 100%;">
                                                <option value="">Select</option>
                                                @foreach($occasionArray as $occasion)
                                                    <option value="{{ $occasion->description }}" @if(!empty(old('occasion')) && $occasion->description == old('occasion')) selected @elseif($occasion->description == $productDetail->occasion) selected @endif>{{ $occasion->description }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product Weight (gms)</label><span style="color: red;"> *</span>
                                            <input type="text" class="form-control" id="product_weight" name="product_weight" value="@if(!empty(old('product_weight'))) {{ old('product_weight') }} @else {{ number_format($productDetail->product_weight, 2, '.', '') }} @endif" placeholder="Enter Product Weight">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product Price ($)</label><span style="color: red;"> *</span>
                                            <input type="text" class="form-control" id="product_price" name="product_price" value="@if(!empty(old('product_price'))) {{ old('product_price') }} @else {{ number_format($productDetail->product_price, 2, '.', '') }} @endif" placeholder="Enter Product Price">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product Discount (%)</label><span style="color: red;"> *</span>
                                            <input type="text" class="form-control" id="product_discount" value="@if(!empty(old('product_discount'))) {{ old('product_discount') }} @else {{ number_format($productDetail->product_discount, 2, '.', '') }} @endif" name="product_discount" placeholder="Enter Product Discount">
                                        </div>
                                        <div class="form-group">
                                            <label for="image">Product Video</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    @if(!empty($productDetail->product_video))
                                                        <input type="hidden" id="current_video" name="current_video" value="{{ $productDetail->product_video }}">
                                                    @endif
                                                    <input type="file" class="custom-file-input" id="product_video" name="product_video">
                                                    <label class="custom-file-label" for="image" @if(!empty($productDetail->product_video)) style="margin-right: 250px;" @endif>Choose file</label>
                                                    @if(!empty($productDetail->product_video))
                                                        <video width="160" height="120" controls>
                                                            <source src="{{ asset('/videos/product_videos/' . $productDetail->product_video) }}" type="video/mp4">
                                                        </video>&nbsp;&nbsp;&nbsp;
                                                        <a href="{{ url('/admin/delete-product-video/' . $productDetail->id) }}"><button type="button" class="btn btn-danger" style="float: right; display: inline-block;">Delete</button></a>
                                                    @endif
                                                </div>
                                            </div>Please use a small video.
                                        </div>
                                        <div class="form-group">
                                            <label>Select Pattern</label><span style="color: red;"> *</span>
                                            <select class="form-control select2" id="pattern_id" name="pattern_id" style="width: 100%;">
                                                <option value="">Select</option>
                                                @foreach($patternArray as $pattern)
                                                    <option value="{{ $pattern->description }}" @if(!empty(old('pattern_id')) && $pattern->description == old('pattern_id')) selected @elseif($pattern->description == $productDetail->pattern) selected @endif>{{ $pattern->description }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Select Fit</label><span style="color: red;"> *</span>
                                            <select class="form-control select2" id="fit_id" name="fit_id" style="width: 100%;">
                                                <option value="">Select</option>
                                                @foreach($fitArray as $fit)
                                                    <option value="{{ $fit->description }}" @if(!empty(old('fit_id')) && $fit->description == old('fit_id')) selected @elseif($fit->description == $productDetail->fit) selected @endif>{{ $fit->description }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Meta Title</label>
                                            <textarea class="form-control" id="meta_title" name="meta_title" rows="3" placeholder="Enter Meta Title ...">@if(!empty(old('meta_title'))) {{ old('meta_title') }} @else {{ $productDetail->meta_title }} @endif</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Meta Keywords</label>
                                            <textarea class="form-control" id="meta_keywords" name="meta_keywords" rows="3" placeholder="Enter Meta Keywords ...">@if(!empty(old('meta_keywords'))) {{ old('meta_keywords') }} @else {{ $productDetail->meta_keywords }} @endif</textarea>
                                        </div>
                                        <div class="form-check" style="text-align: center; padding: 25px 0;">
                                            <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" @if(! ($errors->any() && is_null(old('is_featured'))) && old('is_featured', $productDetail->is_featured)) checked @endif value="1">
                                            <label class="form-check-label" for="is_featured">Is Featured</label>
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
                                    <input type="checkbox" class="form-check-input" id="status" name="status" @if(! ($errors->any() && is_null(old('status'))) && old('status', $productDetail->status)) checked @endif value="1" style="margin-top: 15px;">
                                    <label class="form-check-label" for="status" style="margin-top: 9px;">Status</label>
                                    <button type="submit" class="btn btn-primary" style="float: right; display: inline-block;">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.container-fluid -->
            </section>
        @elseif($title == "Add Product")
            {{-- Add Category --}}
            <section class="content">
                <div class="container-fluid">
                    <!-- SELECT2 EXAMPLE -->
                    <form action="{{ url('/admin/add-edit-product') }}" method="post" enctype="multipart/form-data" id="addProductForm" name="addProductForm">
                        @csrf
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title" style="margin-top: 9px;">{{ ucwords($title) }}</h3>
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
                                            <label>Select Category</label><span style="color: red;"> *</span>
                                            <select class="form-control select2" id="category_id" name="category_id" style="width: 100%;">
                                                <option value="">Select</option>
                                                @foreach($categories as $section)
                                                    <optgroup label="{{ $section->name }}"></optgroup>
                                                    @foreach($section->categories as $category)
                                                        <option value="{{ $category->id }}" @if(!empty(old('category_id')) && $category->id == old('category_id')) selected @endif>&nbsp;&nbsp;&nbsp;&nbsp; {{ $category->category_name }} - {{ $section->name }}</option>
                                                        @foreach($category->subcategories as $subcategory)
                                                            <option value="{{ $subcategory->id }}" @if(!empty(old('category_id')) && $subcategory->id == old('category_id')) selected @endif>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $subcategory->category_name }} - {{ $section->name }}</option>
                                                        @endforeach
                                                    @endforeach
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
                                            </div>Please use a visible clear image.
                                        </div>
                                        <div class="form-group">
                                            <label>Select Fabric</label><span style="color: red;"> *</span>
                                            <select class="form-control select2" id="fabric_id" name="fabric_id" style="width: 100%;">
                                                <option value="">Select</option>
                                                @foreach($fabricArray as $fabric)
                                                    <option value="{{ $fabric->description }}" @if(!empty(old('fabric_id')) && $fabric->description == old('fabric_id')) selected @endif>{{ $fabric->description }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Select Sleeve</label><span style="color: red;"> *</span>
                                            <select class="form-control select2" id="sleeve_id" name="sleeve_id" style="width: 100%;">
                                                <option value="">Select</option>
                                                @foreach($sleeveArray as $sleeve)
                                                    <option value="{{ $sleeve->description }}" @if(!empty(old('sleeve_id')) && $sleeve->description == old('sleeve_id')) selected @endif >{{ $sleeve->description }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Wash Care</label><span style="color: red;"> *</span>
                                            <textarea class="form-control" id="wash_care" name="wash_care" rows="1" placeholder="Enter Wash Care ...">{{ old('wash_care') }}</textarea>
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
                                            <label>Select Occasion</label><span style="color: red;"> *</span>
                                            <select class="form-control select2" id="occasion" name="occasion" style="width: 100%;">
                                                <option value="">Select</option>
                                                @foreach($occasionArray as $occasion)
                                                    <option value="{{ $occasion->description }}" @if(!empty(old('occasion')) && $occasion->description == old('occasion')) selected @endif>{{ $occasion->description }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product Weight (gms)</label><span style="color: red;"> *</span>
                                            <input type="text" class="form-control" id="product_weight" name="product_weight" value="{{ old('product_weight') }}" placeholder="Enter Product Weight">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product Price ($)</label><span style="color: red;"> *</span>
                                            <input type="text" class="form-control" id="product_price" name="product_price" value="{{ old('product_price') }}" placeholder="Enter Product Price">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product Discount (%)</label><span style="color: red;"> *</span>
                                            <input type="text" class="form-control" id="product_discount" value="{{ old('product_discount') }}" name="product_discount" placeholder="Enter Product Discount">
                                        </div>
                                        <div class="form-group">
                                            <label for="image">Product Video</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="product_video" name="product_video">
                                                    <label class="custom-file-label" for="image">Choose file</label>
                                                </div>
                                            </div>Please use a small video.
                                        </div>
                                        <div class="form-group">
                                            <label>Select Pattern</label><span style="color: red;"> *</span>
                                            <select class="form-control select2" id="pattern_id" name="pattern_id" style="width: 100%;">
                                                <option value="">Select</option>
                                                @foreach($patternArray as $pattern)
                                                    <option value="{{ $pattern->description }}" @if(!empty(old('pattern_id')) && $pattern->description == old('pattern_id')) selected @endif>{{ $pattern->description }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Select Fit</label><span style="color: red;"> *</span>
                                            <select class="form-control select2" id="fit_id" name="fit_id" style="width: 100%;">
                                                <option value="">Select</option>
                                                @foreach($fitArray as $fit)
                                                    <option value="{{ $fit->description }}" @if(!empty(old('fit_id')) && $fit->description == old('fit_id')) selected @endif>{{ $fit->description }}</option>
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
                                        <div class="form-check" style="text-align: center; padding: 25px 0;">
                                            <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" @if(!empty(old('is_featured'))) checked @endif value="1">
                                            <label class="form-check-label" for="is_featured">Is Featured</label>
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
                                    <button type="submit" class="btn btn-primary" style="float: right; display: inline-block;">Submit</button>
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
