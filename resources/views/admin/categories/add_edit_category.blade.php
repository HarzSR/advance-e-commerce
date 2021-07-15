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
                    <form action="{{ url('/admin/add-edit-category') }}" method="post" enctype="multipart/form" id="categoryForm" name="categoryForm">
                        @csrf
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Add Category</h3>
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
                                            <label for="exampleInputEmail1">Category Name</label>
                                            <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Enter Category Name">
                                        </div>
                                        <div class="form-group">
                                            <label>Section</label>
                                            <select class="form-control select2" id="section_id" name="section_id" style="width: 100%;">
                                                <option selected="">Select</option>
                                                @foreach($getSections as $getSection)
                                                    <option value="{{ $getSection->id }}">{{ $getSection->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">File input</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="exampleInputFile">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Upload</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" id="category_description" name="category_description" rows="3" placeholder="Enter Category Description ..."></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Meta Description</label>
                                            <textarea class="form-control" id="meta_description" name="meta_description" rows="3" placeholder="Enter Meta Description ..."></textarea>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Category URL</label>
                                            <input type="text" class="form-control" id="category_url" name="category_url" placeholder="Enter Category URL">
                                        </div>
                                        <div class="form-group">
                                            <label>Category Level</label>
                                            <select class="form-control select2" id="parent_id" name="parent_id" style="width: 100%;">
                                                <option selected="0">Main Category</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Category Discount</label>
                                            <input type="text" class="form-control" id="category_discount" name="category_discount" placeholder="Enter Category Discount">
                                        </div>
                                        <div class="form-group">
                                            <label>Meta Title</label>
                                            <textarea class="form-control" id="meta_title" name="meta_title" rows="3" placeholder="Enter Meta Title ..."></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Meta Keywords</label>
                                            <textarea class="form-control" id="meta_keywords" name="meta_keywords" rows="3" placeholder="Enter Meta Keywords ..."></textarea>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" style="float: right;">Submit</button>
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