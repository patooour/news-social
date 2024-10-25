<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="{{config('app.name')}}">

    <title>Dashboard | @yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('assets/admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('assets/admin/css/sb-admin-2.min.css')}}" rel="stylesheet">

    <!-- input-file plugin -->
    <link href="{{asset('assets/vendor/file-input/css/fileinput.min.css')}}" rel="stylesheet" />
    <!-- end input-file plugin -->


    <!-- summer-Note plugin -->
    <link href="{{ asset('assets/vendor/summernote/summernote-bs4.min.css') }}" rel="stylesheet">

    <!--end summer-Note plugin -->


    @stack('css')
    @livewireStyles
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    @include('dashboard.common.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            @include('dashboard.common.header')
            <!-- End of Topbar -->

            @include('dashboard.common.breadcrumb')

            <!-- Begin Page Content -->
            @yield('content')
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
      {{--  @include('dashboard.common.footer')--}}
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
@include('dashboard.common.logout_model')


    <script>
        var adminId = {{auth('admin')->user()->id}};
       var  role = "admin";
    </script>

<script src="{{asset('build/assets/app-COfq36r1.js')}}"></script>


<!-- Bootstrap core JavaScript-->
<script src="{{asset('assets/admin/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('assets/admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('assets/admin/js/sb-admin-2.min.js')}}"></script>

<!-- Page level plugins -->
<script src="{{asset('assets/admin/vendor/chart.js/Chart.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('assets/admin/js/demo/chart-area-demo.js')}}"></script>
<script src="{{asset('assets/admin/js/demo/chart-pie-demo.js')}}"></script>

<!-- input-file plugin -->
<script src="{{asset('assets/vendor/file-input/js/fileinput.min.js')}}"></script>
<script src="{{asset('assets/vendor/file-input/themes/fa5/theme.min.js')}}"></script>
<!-- end input-file plugin -->

<!-- summer-Note plugin -->
<script src="{{ asset('assets/vendor/summernote/summernote-bs4.min.js') }}"></script>
<!-- end summer-Note plugin -->

@stack('js')
@livewireScripts
</body>

</html>