@extends('fronted.common.app')



@section('title')
    Show {{$category->name}}
@endsection

@section('meta_desc')
    {{$category->small_desc}}
@endsection
@push('head')
    <link rel="canonical" href="{{url()->full()}}" />
@endpush


@section('breadCrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{route('fronted.index')}}">Home</a></li>

    <li class="breadcrumb-item">{{$category->name}}</li>

@endsection

@section('content')

    <br> <br>
    <!-- Main News Start-->
    <div class="main-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        @forelse($posts as $post)
                        <div class="col-md-4">
                            <div class="mn-img">
                               {{-- @foreach($post->images as $image)
                                    <img src="{{$image->path}}" alt="">
                                @endforeach--}}
                                    <img src="{{asset($post->images->first()->path ) ?? ''}}" alt="">
                                <div class="mn-title">
                                    <a href="{{route('fronted.post.show',$post->slug)}}"> {{$post->title}} </a>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="alert-danger alert col-md-8">
                           <strong> category is empty !</strong>
                        </div>

                            @endforelse

                    </div>
                    {{$posts->links()}}
                </div>

                <div class="col-lg-3">
                    <div class="mn-list">
                        <h3>Other Categories</h3>
                        <ul>
                            @foreach($categories as $category)
                            <li>
                                <a href="{{route('fronted.category.posts',$category->slug)}}"
                                   title="{{$category->name}}">{{$category->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main News End-->
@endsection
