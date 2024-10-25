<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>{{config('app.name')}} | @yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta
        content="Bootstrap News Template - Free HTML Templates"
        name="keywords"
    />

    <meta
        content="@yield('meta_desc')"
        name="description"
    />



    <!-- Favicon -->
    <link href="{{asset('assets/fronted/img/favicon.ico')}}" rel="icon" />

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Montserrat:400,600&display=swap"
        rel="stylesheet"
    />

    <!-- CSS Libraries -->
    <link
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        rel="stylesheet"
    />
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
        rel="stylesheet"
    />
    <link href="{{asset('assets/fronted/lib/slick/slick.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/fronted/lib/slick/slick-theme.css')}}" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="{{asset('assets/fronted/css/style.css')}}" rel="stylesheet" />

    <!-- input-file plugin -->
    <link href="{{asset('assets/vendor/file-input/css/fileinput.min.css')}}" rel="stylesheet" />
    <!-- end input-file plugin -->


    <!-- summer-Note plugin -->
    <link href="{{ asset('assets/vendor/summernote/summernote-bs4.min.css') }}" rel="stylesheet">

    <!--end summer-Note plugin -->
    @stack('head')
    @yield('css')

</head>

<body>

@include('fronted.common.header')

<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container">
        <ul class="breadcrumb">
            @section('breadCrumb')

            @show
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->


@yield('content')


@include('fronted.common.footer')

@auth
    <script>
        userId = {{auth()->user()->id}};
        role = "user";
    </script>
@endauth
<script src="{{asset('build/assets/app-COfq36r1.js')}}"></script>
<!-- Back to Top -->
<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>


<!-- JavaScript Libraries -->

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('assets/fronted/lib/easing/easing.min.js')}}"></script>
<script src="{{asset('assets/fronted/lib/slick/slick.min.js')}}"></script>

<!-- Template Javascript -->
<script src="{{asset('assets/fronted/js/main.js')}}"></script>


<!-- input-file plugin -->
<script src="{{asset('assets/vendor/file-input/js/fileinput.min.js')}}"></script>
<script src="{{asset('assets/vendor/file-input/themes/fa5/theme.min.js')}}"></script>
<!-- end input-file plugin -->

<!-- summer-Note plugin -->
<script src="{{ asset('assets/vendor/summernote/summernote-bs4.min.js') }}"></script>
<!-- end summer-Note plugin -->

<!-- bootstrap-confirm-delete plugin -->
<script src="{{ asset('assets/vendor/Confirm-Delete/bootstrap-confirm-delete.js') }}"></script>
<!-- end bootstrap-confirm-delete plugin -->

@stack('script')

</body>
</html>