<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf_token" content="{{ csrf_token() }}" />
  <title>DUA NAGA CORP</title>

  <!-- Favicon -->
  <link rel="icon" href="{{ asset('img/cropped-Tanpa-judul-512-x-512-piksel-1-32x32.png') }}" sizes="32x32">
  <link rel="icon" href="{{ asset('img/cropped-Tanpa-judul-512-x-512-piksel-1-192x192.png') }}" sizes="192x192">
  <link rel="apple-touch-icon" href="{{ asset('img/cropped-Tanpa-judul-512-x-512-piksel-1-180x180.png') }}">
  <meta name="msapplication-TileImage" content="{{ asset('img/cropped-Tanpa-judul-512-x-512-piksel-1-270x270.png') }}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">

  @stack('css')

  <style>
    .card-title {
        padding-top: 10px;
    }

    .card-header>.card-tools {
        margin-right: 0 !important;
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
</head>
<body class="hold-transition sidebar-mini">
<div class="overlay"></div>

<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  @include('layouts.admin.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('layouts.admin.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@yield('title')</h1>
          </div>
          {{-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div> --}}
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content pb-4">
      @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @include('layouts.admin.footer')

</div>
<!-- ./wrapper -->

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

<script src="{{ $cdn ?? asset('vendor/sweetalert/sweetalert.all.js') }}"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

@include('sweetalert::alert')


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

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

@stack('js')

{{-- Confirm Delete --}}
<script>
    $('#table').on('click','.confirm_delete',function(){
    Swal.fire({
        title: 'Konfirmasi',
        text: "Apakah anda yakin menghapus data ini?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
    }).then((result) => {
        if (result.value) {
        var _url = $(this).data('url');
        var token = $("meta[name='csrf_token']").attr("content");

        $.ajax(
        {
            url: _url,
            type: 'DELETE',
            data: {
            "_token": token,
            },
            success: function (res){
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            Toast.fire({
                icon: res.status,
                title: res.message
            })

            $('#table').DataTable().ajax.reload();
            }
        });
        }
    });
    })
</script>
</body>
</html>
