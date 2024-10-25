@extends('fronted.common.app')


@section('title')
 Show {{$mainPost->title}}
@endsection


@section('meta_desc')
    {{$mainPost->small_desc}}
@endsection

@push('head')
    <link rel="canonical" href="{{url()->full()}}" />
@endpush

@section('breadCrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{route('fronted.index')}}">Home</a></li>

    <li class="breadcrumb-item"> <a href="{{route('fronted.category.posts',$mainPost->category->slug)}}">{{$mainPost->category->name}}</a></li>
    <li class="breadcrumb-item">{{$mainPost->title}}</li>

@endsection


@section('content')


    <!-- Single News Start-->
    <div class="single-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Carousel -->
                    <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#newsCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#newsCarousel" data-slide-to="1"></li>
                            <li data-target="#newsCarousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            @foreach($mainPost->images as $k => $image)
                            <div class="carousel-item @if($k == 0) active @endif " style="width:650px ;height: 450px">
                                <img src="{{asset($image->path)}}" class="d-block w-100" alt="First Slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>{{$mainPost->title }}</h5>

                                </div>
                            </div>
                            @endforeach
                            <!-- Add more carousel-item blocks for additional slides -->
                        </div>
                        <a class="carousel-control-prev" href="#newsCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#newsCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <div class="alert alert-info col-lg-10">
                      Publisher: <strong class="text-capitalize">{{ $mainPost->user->username  ?? $mainPost->admin->name}}</strong>
                    </div>
                    <div class="sn-content">
                            {!! $mainPost->desc !!}
                    </div>

                    <!-- Comment Section -->

                    <div class="comment-section">


                        @auth
                        <!-- Comment Input -->
                        @if(auth('web')->user()->status != 0 )
                        @if($mainPost->comment_able == 1)
                            <form  id="saveForm">
                                <div class="comment-input">

                                    @csrf
                                    <input type="text" name="comment" placeholder="Add a comment..." id="commentBox" />

                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}"/>

                                    <input type="hidden" name="post_id" value="{{$mainPost->id}}"/>
                                    <button type="submit" >Post</button>

                                </div>
                            </form>
                        @else
                            {{--if comment_able off  --}}
                            <div class="alert alert-danger text-center text-capitalize " >
                            unable to comment
                            </div>
                            {{-- end if comment_able off  --}}
                        @endif
                            @endif
                        @endauth
                        {{--show error msg form --}}
                        <div class="alert alert-danger" id="errorMsg" style="display: none">

                        </div>
                        {{--end error msg form --}}

                        <!-- Display Comments -->
                        <div class="comments">
                            @foreach($mainPost->comments as $comment)
                            <div class="comment">
                                <img src="{{asset($comment->user->image)}}" alt="User Image" class="comment-img" />
                                <div class="comment-content">
                                    <span class="username">{{$comment->user->name}}</span>
                                    <p class="comment-text">{{$comment->comment}}</p>
                                </div>
                            </div>
                            @endforeach
                            <!-- Add more comments here for demonstration -->
                        </div>

                        <!-- Show More Button -->
                        @if($mainPost->comments()->count() > 2 )
                        <button id="showMoreBtn" class="show-more-btn">Show more</button>
                        @endif
                    </div>

                    <!-- Related News -->
                    <div class="sn-related">
                        <h2>Related News</h2>
                        <div class="row sn-slider">
                        @foreach($category_posts as $post)
                            <div class="col-md-4">
                                <div class="sn-img">
                                    <img src="{{asset($post->images->first()->path)}}" class="img-fluid" alt="{{$post->title}}" />
                                    <div class="sn-title">
                                        <a href="{{route('fronted.post.show',$post->slug)}}">{{$post->title}}</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="sidebar-widget">
                            <h2 class="sw-title">In This Category</h2>
                            <div class="news-list">
                            @foreach($category_posts as $post)
                               <div class="nl-item">
                                    <div class="nl-img">
                                        <img src="{{asset($post->images->first()->path)}}" />
                                    </div>
                                    <div class="nl-title">
                                        <a href="{{route('fronted.post.show',$post->slug)}}"
                                        >{{$post->title}}</a
                                        >
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                      {{--  <div class="sidebar-widget">
                            <div class="image">
                                <a href="https://htmlcodex.com"
                                ><img src="img/ads-2.jpg" alt="Image"
                                    /></a>
                            </div>
                        </div>--}}

                        {{--
   @foreach($latest_posts as $post)
                                        <div class="tn-news">
                                            <div class="tn-img">
                                                <img src="{{$post->images->first()->path}}" />
                                            </div>
                                            <div class="tn-title">
                                                <a href="{{route('fronted.post.show',$post->slug)}}"
                                                >{{$post->title}}</a
                                                >
                                            </div>
                                        </div>
                                        @endforeach
--}}

                        <div class="sidebar-widget">
                            <div class="tab-news">
                                <ul class="nav nav-pills nav-justified">
                                    <li class="nav-item">
                                        <a
                                            class="nav-link active"
                                            data-toggle="pill"
                                            href="#latest"
                                        >Latest</a
                                        >
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#popular"
                                        >Popular</a
                                        >
                                    </li>

                                </ul>

                                <div class="tab-content">
                                    <div id="latest" class="container tab-pane active">
                                        @foreach($latest_posts as $post)
                                            <div class="tn-news">
                                                <div class="tn-img">
                                                    <img src="{{asset($post->images->first()->path)}}" />
                                                </div>
                                                <div class="tn-title">
                                                    <a href="{{route('fronted.post.show',$post->slug)}}"
                                                    >{{$post->title}}</a
                                                    >
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                    <div id="popular" class="container tab-pane fade">

                                        @foreach($great_posts_comment as $post)
                                            <div class="tn-news">
                                                <div class="tn-img">
                                                    <img src="{{asset($post->images->first()->path)}}" />
                                                </div>
                                                <div class="tn-title">
                                                    <a href="{{route('fronted.post.show',$post->slug)}}"
                                                    >{{$post->title}}</a
                                                    >
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--<div class="sidebar-widget">
                            <div class="image">
                                <a href="https://htmlcodex.com"
                                ><img src="img/ads-2.jpg" alt="Image"
                                    /></a>
                            </div>
                        </div>--}}

                        <div class="sidebar-widget">
                            <h2 class="sw-title">News Category</h2>
                            <div class="category">
                                <ul>
                                   @foreach($categories as $category)
                                    <li><a href="">{{$category->name}}</a><span>({{$category->posts->count()}})</span></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                      {{--  <div class="sidebar-widget">
                            <div class="image">
                                <a href="https://htmlcodex.com"
                                ><img src="img/ads-2.jpg" alt="Image"
                                    /></a>
                            </div>
                        </div>--}}


                </div>
            </div>
        </div>
    </div>
    <!-- Single News End-->


@endsection

@push('script')
            <script>

                // show more comment
                $(document).on('click' , '#showMoreBtn' , function (e){
                   e.preventDefault();

                   $.ajax({
                       url: "{{route('fronted.post.comment.all' ,$mainPost->slug)}}" ,
                       type : "GET",

                       success:function (data){
                            $('.comments').empty();

                            $.each(data.data , function (key , value) {

                                $('.comments').append(`
                                    <div class="comment">
                                        <img src="${value.user.image}" alt="User Image" class="comment-img" />
                                        <div class="comment-content">
                                            <span class="username">${value.user.name}</span>
                                            <p class="comment-text">${value.comment}</p>
                                        </div>
                                    </div>
                                `);

                                $('#showMoreBtn').hide();
                            })
                       },
                       error:function (data){

                       }

                   })
                });



                //save form comment
                $(document).on('submit','#saveForm' , function (e){
                  e.preventDefault();

                    var formData = new FormData($(this)[0]);

                    $('#commentBox').val('');

                     $.ajax({
                        url:"{{route('fronted.post.comment.store')}}",
                        type:"POST",
                        data: formData ,
                        processData: false,
                        contentType:false,
                        success:function (data){
                            $('#errorMsg').hide();

                            // show add comment first in top by prepend
                            // show add comment first in last by append

                            $('.comments').prepend(`
                                    <div class="comment">
                                        <img src="${data.data.user.image}" alt="User Image" class="comment-img" />
                                        <div class="comment-content">
                                            <span class="username">${data.data.user.name}</span>
                                            <p class="comment-text">${data.data.comment}</p>
                                        </div>
                                    </div>
                                `);

                        },
                        error: function(data) {
                            // first parse data to print ..... success make it auto
                            var res = $.parseJSON(data.responseText);
                            console.log(res.msg[0]);

                            $('#errorMsg').text(res.msg[0]).show();


                        }

                    })
                })


            </script>
@endpush

