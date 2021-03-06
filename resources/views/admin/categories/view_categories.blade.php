@extends('layouts.admin_layout.admin_layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Catalogues</h1>
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
                            <li class="breadcrumb-item active">Categories</li>
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
                                <h3 class="card-title" style="margin-top: 5px;">Categories Data</h3>
                                <a href="{{ url('/admin/add-edit-category/') }}"><button type="button" class="btn btn-primary btn-sm" style="float: right; display: inline-block;">Add Category</button></a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="categories" class="table table-bordered table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Section</th>
                                        <th>Parent Category</th>
                                        <th>Name</th>
                                        <th>URL</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ ucwords($category->section->name) }}</td>
                                            <td>@if(!empty($category->parentCategory)) {{ ucwords($category->parentCategory->category_name) }} @else  @endif</td>
                                            <td>{{ ucwords($category->category_name) }}</td>
                                            <td>{{ $category->url }}</td>
                                            <td>
                                                @if($category->status == 1)
                                                    <a class="updateCategoryStatus" id="category-{{ $category->id }}" category_id="{{ $category->id }}" href="javascript:void(0)"><button type="button" class="btn btn-success btn-sm" style="pointer-events: none;">Active</button><span id="ajaxStatus-{{ $category->id }}" class="ajaxStatus-{{ $category->id }}"></span></a>
                                                @else
                                                    <a class="updateCategoryStatus" id="category-{{ $category->id }}" category_id="{{ $category->id }}" href="javascript:void(0)"><button type="button" class="btn btn-danger btn-sm" style="pointer-events: none;">Inactive</button><span id="ajaxStatus-{{ $category->id }}" class="ajaxStatus-{{ $category->id }}"></span></a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('/admin/add-edit-category/' . $category->id) }}"><button type="button" class="btn btn-warning btn-sm">Edit</button></a>
                                                {{-- <a class="confirmCategoryDelete" name="Category {{ $category->id }} : {{ ucwords($category->section->name) }} - {{ ucwords($category->category_name) }}" href="{{ url('/admin/delete-category/' . $category->id) }}"><button type="button" class="btn btn-danger btn-sm">Delete</button></a> --}}
                                                <a href="javascript:void(0)" class="confirmDelete" record="Category" recordid="{{ $category->id }} : {{ ucwords($category->section->name) }} - {{ ucwords($category->category_name) }}" dataName="category" dataId="{{ $category->id }}"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Section</th>
                                        <th>Parent Category</th>
                                        <th>Name</th>
                                        <th>URL</th>
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
