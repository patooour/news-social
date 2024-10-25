@extends('fronted.common.app')



@section('title')
    Search-news
@endsection

@section('breadCrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{route('fronted.index')}}">Home</a></li>

@endsection

@section('content')

    <br><br>

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
                                    <img src="{{$image->path}}" alt="">
                                @endforeach--}}
                                    <img src="{{$post->images->first()->path }}" alt="">
                                <div class="mn-title">
                                    <a href="{{route('fronted.post.show',$post->slug)}}"> {{$post->title}} </a>
                                </div>
                            </div>
                        </div>

                            @endforeach
                            {{$posts->links()}}
                    </div>

                </div>


            </div>
        </div>
    </div>
    <!-- Main News End-->
@endsection
