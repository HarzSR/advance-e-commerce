@extends('layouts.admin_layout.admin_layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Admin Details</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Admin Details</li>
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
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title" style="margin-top: 10px;">Update Details</h3>
                                <a href="{{ url('/admin/dashboard') }}"><button class="btn btn-danger" style="float: right;">Dashboard</button></a>
                            </div>
                            @if(Session::has('error_message'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{-- <strong>Oopsy!</strong> Something is wrong. Please try again. --}}
                                    <strong>Oopsy!</strong> {{ Session::get('error_message') }}.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if(Session::has('success_message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Bam!</strong> {{ Session::get('success_message') }}.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post" action="{{ url('/admin/update-admin-details') }}" name="updateSettings" id="updateSettings" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">User Email</label>
                                        <input type="text" class="form-control" value="{{ $userDetails->email }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">User Type</label>
                                        <input type="text" class="form-control" value="{{ ucwords($userDetails->type) }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">User Name<span style="color: red;"> *</span></label>
                                        <input type="text" class="form-control" id="username" name="username" value="@if(!empty(old('username'))) {{ old('username') }} @else {{ trim($userDetails->name) }} @endif" placeholder="Enter Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">User Number<span style="color: red;"> *</span></label>
                                        {{-- <input type="tel" class="form-control" id="mobile" name="mobile" value="@if(!empty(old('mobile'))) {{ old('mobile') }} @else {{ trim($userDetails->mobile) }} @endif" placeholder="Enter Number" pattern="[0-9]{10}" > --}}
                                        <input type="tel" class="form-control" id="mobile" name="mobile" value="@if(!empty(old('mobile'))) {{ old('mobile') }} @else {{ trim($userDetails->mobile) }} @endif" placeholder="Enter Number">
                                    </div>
                                    <div class="custom-file">
                                        <label for="exampleInputFile">User Image<span style="color: red;"> *</span></label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="image" id="image">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" style="float: right;">Update Details</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
