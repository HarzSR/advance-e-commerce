@extends('layouts.admin_layout.admin_layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Brands</h1>
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
                            <li class="breadcrumb-item active">Brands</li>
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
                                <h3 class="card-title" style="margin-top: 5px;">Brand Data</h3>
                                <a href="{{ url('/admin/add-edit-brands/') }}"><button type="button" class="btn btn-primary btn-sm" style="float: right; display: inline-block;">Add Brands</button></a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="categories" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($brands as $brand)
                                            <tr>
                                                <td>{{ $brand->id }}</td>
                                                <td>{{ ucwords($brand->name) }}</td>
                                                <td>
                                                    @if($brand->status == 1)
                                                        <a class="updateCategoryStatus" id="brand-{{ $brand->id }}" brand_id="{{ $brand->id }}" href="javascript:void(0)"><button type="button" class="btn btn-success btn-sm" style="pointer-events: none;">Active</button><span id="ajaxStatus-{{ $brand->id }}" class="ajaxStatus-{{ $brand->id }}"></span></a>
                                                    @else
                                                        <a class="updateCategoryStatus" id="brand-{{ $brand->id }}" brand_id="{{ $brand->id }}" href="javascript:void(0)"><button type="button" class="btn btn-danger btn-sm" style="pointer-events: none;">Inactive</button><span id="ajaxStatus-{{ $brand->id }}" class="ajaxStatus-{{ $brand->id }}"></span></a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" class="confirmDelete" record="Brand" recordid="{{ $brand->id }}" dataName="brand" dataId="{{ $brand->id }}"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
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
