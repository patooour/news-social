@extends('dashboard.common.app')

@section('title')
    Home
@endsection

@push('css')
    <link rel="canonical" href="{{url()->full()}}"/>

@endpush


@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <!-- Content Row -->
        @livewire('admin.statics')

        <!-- Content Row -->

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                        <h1 class="card-header">{{ $chart_posts->options['chart_title'] }}</h1>
                        {!! $chart_posts->renderHtml() !!}
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <!-- Pie chart - Dropdown -->
                    <h1 class="card-header">{{ $chart_users->options['chart_title'] }}</h1>
                    {!! $chart_users->renderHtml() !!}
                </div>
            </div>

            <!-- bar Chart -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <h1 class="card-header"> {{ $chart_contacts->options['chart_title'] }}</h1>
                    {!! $chart_contacts->renderHtml() !!}
                </div>
            </div>

            <!-- bar Chart -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <h1 class="card-header"> {{ $chart_comments->options['chart_title'] }}</h1>
                    {!! $chart_comments->renderHtml() !!}
                </div>
            </div>
        </div>

        <!-- posts - comments table -->
        @livewire('admin.latest-posts-comments')
    </div>
    <!-- /.container-fluid -->

@endsection


@push('js')
    <script>
        {!! $chart_posts->renderChartJsLibrary() !!}
        {!! $chart_posts->renderJs() !!}
        {!! $chart_contacts->renderJs() !!}
        {!! $chart_users->renderJs() !!}
        {!! $chart_comments->renderJs() !!}
    </script>

@endpush
