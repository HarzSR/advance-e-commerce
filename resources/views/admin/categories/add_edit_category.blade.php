@extends('layouts.admin_layout.admin_layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Catalogues</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                            @if($title == "Edit Category")
                                <li class="breadcrumb-item active">Edit Category</li>
                            @elseif($title == "Add Category")
                                <li class="breadcrumb-item active">Add Category</li>
                            @endif
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        @if($title == "Edit Category")
            {{-- Edit Category --}}
        @elseif($title == "Add Category")
            {{-- Add Category --}}
            <section class="content">
                <div class="container-fluid">
                    <!-- SELECT2 EXAMPLE -->
                    <form action="{{ url('/admin/add-edit-category') }}" method="post" enctype="multipart/form-data" id="categoryForm" name="categoryForm">
                        @csrf
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Add Category</h3>
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
                                    {{-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button> --}}
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Category Name</label><span style="color: red;"> *</span>
                                            <input type="text" class="form-control" id="category_name" name="category_name" value="{{ old('category_name') }}" placeholder="Enter Category Name">
                                        </div>
                                        <div class="form-group">
                                            <label>Section</label><span style="color: red;"> *</span>
                                            <select class="form-control select2" id="section_id" name="section_id" style="width: 100%;">
                                                <option value="0">Select</option>
                                                @if(!old('section_id'))
                                                    @foreach($getSections as $getSection)
                                                        <option value="{{ $getSection->id }}">{{ $getSection->name }}</option>
                                                    @endforeach
                                                @else
                                                    @foreach($getSections as $getSection)
                                                        <option value="{{ $getSection->id }}" @if($getSection->id == old('section_id')) selected @endif>{{ $getSection->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="image">File input</label><span style="color: red;"> *</span>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="image" name="image">
                                                    <label class="custom-file-label" for="image">Choose file</label>
                                                </div>
                                                {{-- <div class="input-group-append">
                                                    <span class="input-group-text">Upload</span>
                                                </div> --}}
                                            </div>
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
                                            <label for="exampleInputEmail1">Category URL</label><span style="color: red;"> *</span>
                                            <input type="text" class="form-control" id="category_url" name="category_url" value="{{ old('category_url') }}" placeholder="Enter Category URL">
                                        </div>
                                        <div id="append_categories_level" name="append_categories_level">
                                            <script>
                                                var parent_id = @if(old('parent_id')) {{ old('parent_id') }} @else null @endif
                                            </script>

                                            @include('admin.categories.append_categories_level')

                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Category Discount</label><span style="color: red;"> *</span>
                                            <input type="text" class="form-control" id="category_discount" value="{{ old('category_discount') }}" name="category_discount" placeholder="Enter Category Discount">
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
