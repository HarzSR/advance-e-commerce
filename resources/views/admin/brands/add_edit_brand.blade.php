@extends('layouts.admin_layout.admin_layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Brands</h1>
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
        @if($title == "Edit Brand")
            {{-- Edit Category --}}
            <section class="content">
                <div class="container-fluid">
                    <!-- SELECT2 EXAMPLE -->
                    <form action="{{ url('/admin/add-edit-brand/' . $brandDetails->id) }}" method="post" enctype="multipart/form-data" id="categoryForm" name="categoryForm">
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
                                    <a href="{{ url('/admin/view-brands') }}"><button type="button" class="btn btn-primary">View Brands</button></a>
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
                                            <label for="exampleInputEmail1">Brand Name</label><span style="color: red;"> *</span>
                                            <input type="text" class="form-control" id="brand_name" name="brand_name" value="@if(!empty(old('brand_name'))) {{ old('brand_name') }} @else {{ $brandDetails->name }} @endif" placeholder="Enter Brand Name">
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="status" name="status" @if(! ($errors->any() && is_null(old('status'))) && old('status', $brandDetails->status)) checked @endif value="1" style="margin-top: 15px;">
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
        @elseif($title == "Add Brand")
            {{-- Add Category --}}
            <section class="content">
                <div class="container-fluid">
                    <!-- SELECT2 EXAMPLE -->
                    <form action="{{ url('/admin/add-edit-brand') }}" method="post" enctype="multipart/form-data" id="brandForm" name="brandForm">
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
                                    <a href="{{ url('/admin/view-brands') }}"><button type="button" class="btn btn-primary">View Brands</button></a>
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
                                            <label for="exampleInputEmail1">Brand Name</label><span style="color: red;"> *</span>
                                            <input type="text" class="form-control" id="brand_name" name="brand_name" value="{{ old('brand_name') }}" placeholder="Enter Brand Name">
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
