<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Advance E Commerce | {{ \Request::route()->getName() }} </title>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ url('/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bootstrap 4 -->
        <link rel="stylesheet" href="{{ url('/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
        <!-- daterange picker -->
        <link rel="stylesheet" href="{{ url('/plugins/daterangepicker/daterangepicker.css') }}">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{ url('/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <!-- Bootstrap Color Picker -->
        <link rel="stylesheet" href="{{ url('/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
        <!-- Tempusdominus Bootstrap 4 -->
        <link rel="stylesheet" href="{{ url('/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ url('/plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ url('/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
        <!-- Bootstrap4 Duallistbox -->
        <link rel="stylesheet" href="{{ url('/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
        <!-- BS Stepper -->
        <link rel="stylesheet" href="{{ url('/plugins/bs-stepper/css/bs-stepper.min.css') }}">
        <!-- dropzonejs -->
        <link rel="stylesheet" href="{{ url('/plugins/dropzone/min/dropzone.min.css') }}">
        <!-- JQVMap -->
        <link rel="stylesheet" href="{{ url('/plugins/jqvmap/jqvmap.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ url('/css/admin_css/adminlte.min.css') }}">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{ url('/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
        <!-- summernote -->
        <link rel="stylesheet" href="{{ url('/plugins/summernote/summernote-bs4.min.css') }}">

        <!-- DataTables -->
        <link rel="stylesheet" href="{{ url('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ url('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ url('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    </head>
    <body class="hold-transition dark-mode sidebar-mini layout-fixed">
        <div class="wrapper">

            <!-- Preloader -->
            <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__shake" src="{{ asset('/images/admin_images/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
            </div>

            @include('layouts.admin_layout.admin_header')

            @include('layouts.admin_layout.admin_sidebar')

            @yield('content')

            @include('layouts.admin_layout.admin_footer')

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="{{ url('/plugins/jquery/jquery.min.js') }}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{ url('/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="{{ url('/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- Select2 -->
        <script src="{{ url('/plugins/select2/js/select2.full.min.js') }}"></script>
        <!-- Bootstrap4 Duallistbox -->
        <script src="{{ url('/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
        <!-- ChartJS -->
        <script src="{{ url('/plugins/chart.js/Chart.min.js') }}"></script>
        <!-- Sparkline -->
        <script src="{{ url('/plugins/sparklines/sparkline.js') }}"></script>
        <!-- JQVMap -->
        {{-- <script src="{{ url('/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
        <script src="{{ url('/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script> --}}
        <!-- jQuery Knob Chart -->
        <script src="{{ url('/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
        <!-- daterangepicker -->
        <script src="{{ url('/plugins/moment/moment.min.js') }}"></script>
        <script src="{{ url('/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
        <script src="{{ url('/plugins/daterangepicker/daterangepicker.js') }}"></script>
        <!-- bootstrap color picker -->
        <script src="{{ url('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="{{ url('/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
        <!-- Bootstrap Switch -->
        <script src="{{ url('/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
        <!-- BS-Stepper -->
        <script src="{{ url('/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
        <!-- dropzonejs -->
        <script src="{{ url('/plugins/dropzone/min/dropzone.min.js') }}"></script>
        <!-- Summernote -->
        <script src="{{ url('/plugins/summernote/summernote-bs4.min.js') }}"></script>
        <!-- overlayScrollbars -->
        <script src="{{ url('/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ url('/js/admin_js/adminlte.js') }}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{ url('/js/admin_js/demo.js') }}"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{ url('/js/admin_js/pages/dashboard.js') }}"></script>
        <!-- Custom Script -->
        <script src="{{ url('/js/admin_js/admin_script.js') }}"></script>
        <!-- Sweet Alert Script -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- DataTables  & Plugins -->
        <script src="{{ url('plugins/datatables/jquery.dataTables.min.js')  }}"></script>
        <script src="{{ url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')  }}"></script>
        <script src="{{ url('plugins/datatables-responsive/js/dataTables.responsive.min.js')  }}"></script>
        <script src="{{ url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')  }}"></script>
        <script src="{{ url('plugins/datatables-buttons/js/dataTables.buttons.min.js')  }}"></script>
        <script src="{{ url('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')  }}"></script>
        <script src="{{ url('plugins/jszip/jszip.min.js')  }}"></script>
        <script src="{{ url('plugins/pdfmake/pdfmake.min.js')  }}"></script>
        <script src="{{ url('plugins/pdfmake/vfs_fonts.js')  }}"></script>
        <script src="{{ url('plugins/datatables-buttons/js/buttons.html5.min.js')  }}"></script>
        <script src="{{ url('plugins/datatables-buttons/js/buttons.print.min.js')  }}"></script>
        <script src="{{ url('plugins/datatables-buttons/js/buttons.colVis.min.js')  }}"></script>

        <!-- Page specific script -->
        <script>
            @if(Session::get('page') == "view-sections")
                $(function () {
                    $("#sections").DataTable({
                        "responsive": true,
                        "lengthChange": false,
                        "autoWidth": false,
                        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                        "columns": [
                            null,
                            null,
                            null,
                            { "visible": false },
                        ],
                    }).buttons().container().appendTo('#sections_wrapper .col-md-6:eq(0)');
                });
            @endif
            @if(Session::get('page') == "view-categories")
                $(function () {
                    $("#categories").DataTable({
                        "responsive": true,
                        "lengthChange": false,
                        "autoWidth": false,
                        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                        "columns": [
                            null,
                            null,
                            null,
                            null,
                            null,
                            null,
                            { "visible": false },
                        ],
                    }).buttons().container().appendTo('#categories_wrapper .col-md-6:eq(0)');
                });
            @endif
            @if(Session::get('page') == "view-products")
                $(function () {
                    $("#products").DataTable({
                        "responsive": true,
                        "lengthChange": false,
                        "autoWidth": false,
                        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                        "columns": [
                            null,
                            null,
                            null,
                            null,
                            null,
                            null,
                            null,
                            null,
                            null,
                            { "visible": false },
                        ],
                    }).buttons().container().appendTo('#products_wrapper .col-md-6:eq(0)');
                });
            @endif
            @if(Session::get('page') == "add-attributes")
                $(function () {
                    $("#viewAttributes").DataTable({
                        "responsive": true,
                        "lengthChange": false,
                        "autoWidth": false,
                        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                        "columns": [
                            null,
                            null,
                            null,
                            null,
                            null,
                            null,
                        ],
                    }).buttons().container().appendTo('#viewAttributes_wrapper .col-md-6:eq(0)');
                });
            @endif
            @if(Session::get('page') == "add-edit-category")
                $(function () {
                    //Initialize Select2 Elements
                    $('.select2').select2()

                    //Initialize Select2 Elements
                    $('.select2bs4').select2({
                        theme: 'bootstrap4'
                    })
                })
            @endif
        </script>
    </body>
</html>
