<!DOCTYPE html><html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BANK SUMUT | Report</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    {{-- select2 --}}
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">

    <style>
        .content-header {
            padding: 15px 0;
        }

        .card-title{
            font-size: 1rem;
        }
    </style>

    <style>
        .overlay{
            display: none;
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 9999;
            background: rgba(255,255,255,0.8) url("{{ asset('assets/loader.gif') }}") center no-repeat;
        }
        /* Turn off scrollbar when body element has the loading class */
        body.loading{
            overflow: hidden;
        }
        /* Make spinner image visible when body element has the loading class */
        body.loading .overlay{
            display: block;
        }
    </style>

    @stack('css')
</head>
<body class="hold-transition layout-top-nav">
    <div class="overlay"></div>

    <div class="wrapper" style="background-color: #f4f6f9;">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="#" class="navbar-brand">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="brand-image" style="height: 45px;margin-top: -1px;">
                    <span class="brand-text" style="font-weight: 400;color: transparent">..</span>
                </a>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <span class="mr-2">{{auth()->user()->name ?? 'Administrator'}}</span>
                            <i class="fas fa-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu dropdown-menu-right">
                            @role('admin')
                            <a href="{{route('categories.index')}}" class="dropdown-item" style="padding: 0px 1rem;">Administrator</a>
                            @endrole
                            <a href="#" class="dropdown-item" style="padding: 0px 1rem;">Profile</a>
                            <div class="dropdown-divider"></div>
                            {{-- <a href="{{route('logout')}}" class="dropdown-item" style="padding: 0px 1rem;">Logout</a> --}}
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    @yield('content')
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                V1.0.0
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2024 <a href="#" style="color: #ffc107;">Bank Sumut</a></strong>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>
    {{-- Chart JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0"></script>
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(document).on({
            ajaxStart: function(){
                $("body").addClass("loading");
            },
            ajaxStop: function(){
                $("body").removeClass("loading");
            }
        });
    </script>

    @stack('js')
</body>
</html>
