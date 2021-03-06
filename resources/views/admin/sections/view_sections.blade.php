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
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Sections</li>
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
                                <h3 class="card-title">Sections Data</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="sections" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sections as $section)
                                            <tr>
                                                <td>{{ $section->id }}</td>
                                                <td>{{ $section->name }}</td>
                                                <td>
                                                    @if($section->status == 1)
                                                        <a class="updateSectionStatus" id="section-{{ $section->id }}" section_id="{{ $section->id }}" href="javascript:void(0)"><button type="button" class="btn btn-success btn-sm" style="pointer-events: none;">Active</button><span id="ajaxStatus-{{ $section->id }}" class="ajaxStatus-{{ $section->id }}"></span></a>
                                                    @else
                                                        <a class="updateSectionStatus" id="section-{{ $section->id }}" section_id="{{ $section->id }}" href="javascript:void(0)"><button type="button" class="btn btn-danger btn-sm" style="pointer-events: none;">Inactive</button><span id="ajaxStatus-{{ $section->id }}" class="ajaxStatus-{{ $section->id }}"></span></a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-warning btn-sm">Edit</button>
                                                    <button type="button" class="btn btn-danger btn-sm">Delete</button>
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
