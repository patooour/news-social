@extends('fronted.common.app')

@section('title')
Home
@endsection

@push('head')
    <link rel="canonical" href="{{url()->full()}}" />
@endpush
@section('meta_desc')
    {{ $settings->small_desc }}
@endsection

@section('breadCrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{route('fronted.index')}}">Home</a></li>

@endsection

@section('content')


    @php
        $latest_three = $posts->take(3);
    @endphp
    <!-- Top News Start-->
    <div class="top-news">
        <div class="container">
            <div class="row">
                <div class="col-md-6 tn-left">
                    <div class="row tn-slider">
                        @foreach($latest_three as $post)
                        <div class="col-md-6">
                            <div class="tn-img">
                                <img src="{{ asset($post->images->first()->path) ?? ''}} " style="width:510px ;height: 383px"/>
                                <div class="tn-title">
                                    <a href="{{route('fronted.post.show',$post->slug)}}">{{$post->title}}</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-md-6 tn-right">
                    @php
                        $four_posts = $posts->take(4);
                    @endphp


                    <div class="row">
                        @foreach($four_posts as $post)
                        <div class="col-md-6">
                            <div class="tn-img">
                                <img src="{{asset($post->images->first()->path) ?? ''}}" style="width:250px ;height: 170px"/>
                                <div class="tn-title">
                                    <a href="{{route('fronted.post.show',$post->slug)}}">{{$post->title}}</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>


                </div>

            </div>
        </div>
    </div>
    <!-- Top News End-->


    <!-- Category News Start-->
    <div class="cat-news">
        <div class="container">
            <div class="row">

               @foreach($top_category as $category)
                    @if($category->posts->count() > 0)
                    <div class="col-md-6">
                        <h2>{{$category->name}}</h2>
                        <div class="row cn-slider">
                            @foreach($category->posts as $post)
                            <div class="col-md-6">
                                <div class="cn-img">
                                    <img src="{{ asset($post->images->first()->path) ?? '' }}" style="width:470px ;height: 200px"/>
                                    <div class="cn-title">
                                        <a href="{{route('fronted.post.show',$post->slug)}}">{{$post->title}}</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
               @endforeach

            </div>
        </div>
    </div>
    <!-- Category News End-->


    <!-- Tab News Start-->
    <div class="tab-news">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#Latest"
                            >Latest News</a
                            >
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#Read"
                            >Most Read</a
                            >
                        </li>

                    </ul>

                    <div class="tab-content">



                        <div id="Latest" class="container tab-pane active">
                            @foreach($latest_three as $post)
                            <div class="tn-news">
                                <div class="tn-img">
                                    <img src="{{asset($post->images->first()->path) ?? ''}}" alt='' style="width:150px ;height: 113px"/>
                                </div>
                                <div class="tn-title">
                                    <a href="{{route('fronted.post.show',$post->slug)}}">{{$post->title}}</a>
                                </div>
                            </div>
                            @endforeach
                        </div>


                        <div id="Read" class="container tab-pane fade">
                         @foreach($most_view_posts as $mostView)
                            <div class="tn-news">
                                <div class="tn-img">
                                    <img src="{{asset($mostView->images->first()->path)?? '' }}" />
                                </div>
                                <div class="tn-title">
                                    <a href="{{route('fronted.post.show',$mostView->slug)}}">{{$mostView->title}} ({{$mostView->num_of_views}})</a>
                                </div>
                            </div>

                            @endforeach
                        </div>

                    </div>
                </div>

                <div class="col-md-6">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#oldest"
                            >Oldest News</a
                            >
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#popular"
                            >Popular News</a
                            >
                        </li>

                    </ul>

                    <div class="tab-content">
                        <div id="oldest" class="container tab-pane active">
                           @foreach($oldest_posts as $post)
                            <div class="tn-news">
                                <div class="tn-img">
                                    <img src="{{asset($post->images->first()->path) ?? ''}}" />
                                </div>
                                <div class="tn-title">
                                    <a href="{{route('fronted.post.show',$post->slug)}}">{{$post->title}}</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div id="popular" class="container tab-pane fade">
                            @foreach($great_posts_comment as $post)
                            <div class="tn-news">
                                <div class="tn-img">
                                    <img src="{{asset($post->images->first()->path) ?? ''}}" />
                                </div>
                                <div class="tn-title">
                                    <a href="{{route('fronted.post.show',$post->slug)}}">{{$post->title}} <br> comments ({{$post->comments_count}})</a>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tab News Start-->

    <!-- Main News Start-->
    <div class="main-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        @foreach($posts as $post)
                        <div class="col-md-4">
                            <div class="mn-img">
                               {{-- @foreach($post->images as $image)
                                    <img src="{{$image->path}}" alt=''>
                                @endforeach--}}
                                    <img src="{{asset($post->images->first()->path) ?? '' }}" alt='' style="width:200px ;height: 150px">
                                <div class="mn-title">
                                    <a href="{{route('fronted.post.show',$post->slug)}}"> {{$post->title}} </a>
                                </div>
                            </div>
                        </div>

                            @endforeach
                            {{$posts->links()}}
                    </div>

                </div>

                <div class="col-lg-3">
                    <div class="mn-list">
                        <h2>Read More</h2>
                        <ul>
                            @foreach($read_posts as $post)
                            <li><a href="{{route('fronted.post.show',$post->slug)}}">{{$post->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main News End-->
@endsection
