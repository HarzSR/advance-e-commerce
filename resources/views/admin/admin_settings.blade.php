@extends('layouts.admin_layout.admin_layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Settings</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Settings</li>
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
                                <h3 class="card-title" style="margin-top: 10px;">Update Settings</h3>
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
                            <form role="form" method="post" action="{{ url('/admin/update-settings') }}" name="updateSettings" id="updateSettings">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">User Name<span style="color: red;"> *</span></label>
                                        <input type="text" class="form-control" id="username" name="username" value="@if(!empty(old('username'))) {{ old('username') }} @else {{ $userDetails->name }} @endif" placeholder="Enter Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">User Email</label>
                                        <input type="text" class="form-control" value="{{ $userDetails->email }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">User Email</label>
                                        <input type="text" class="form-control" value="{{ $userDetails->type }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="current_password">Old/Current Password<span style="color: red;"> *</span></label>
                                        <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Old/Current Password" required>
                                        <span id="currentPassword"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password">New Password<span style="color: red;"> *</span></label>
                                        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm_password">Confirm Password<span style="color: red;"> *</span></label>
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" style="float: right;">Update Settings</button>
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
