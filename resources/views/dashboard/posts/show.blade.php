@extends('dashboard.common.app')

@section('title')
    Show User Details
@endsection

@section('breadCrumb')
    @parent

@endsection

@push('css')
    <link rel="canonical" href="{{url()->full()}}"/>
@endpush


@section('content')

    <div class="container-fluid mb-4">
        <div class="row">
            <div class="col-lg-7">
                <div class="card card-body ">
                    <div class="card-body text-center">
                        <!-- Carousel -->
                        <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#newsCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#newsCarousel" data-slide-to="1"></li>
                                <li data-target="#newsCarousel" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                @foreach($post->images as $k => $image)
                                    <div class="carousel-item @if($k == 0) active @endif "
                                         style="width:650px ;height: 450px">
                                        <img src="{{asset($image->path)}}" class="d-block w-100" alt="First Slide">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>{{$post->title }}</h5>

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

                        <br>
                        <div class="sn-content">
                            {{$post->small_desc}}
                        </div>
                        <br>
                        <div class="sn-content">
                            {!! $post->desc !!}
                        </div>
                        <h6 style="margin-left: 500px">{{$post->created_at->diffForHumans()}}</h6>
                        <br>
                        <div class="d-flex justify-content-center mb-2">

                            <a href="{{route('admin.posts.block' , $post->id)}}"
                               class="btn btn-warning"
                            >@if($post->status == 1)
                                    Block <i class="fa fa-play"></i>
                                @else
                                    Activate <i class="fa fa-stop"></i>
                                @endif</a>
                            @if($post->user == null)
                                <a href="{{route('admin.posts.edit' , $post->id)}}"
                                   class="btn btn-info mx-1"
                                >Edit <i class="fa fa-edit"></i></a>
                            @endif
                            <a href="javascript:void(0)" onclick="if(confirm('do you want to delete this post')) {
                                    document.getElementById('delete_user_form_{{$post->id}}').submit() } return false
                                " id="delete_user_{{$post->id}}"
                               class="btn btn-danger mx-1">Delete <i class="fa fa-trash"></i></a>

                            <a id="show_comments"
                               class="btn btn-info mx-1">Show Comments <i class="fa fa-comment"></i></a>

                            <form id="delete_user_form_{{$post->id}}"
                                  action="{{route('admin.posts.destroy' , $post->id )}}" method="post">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </div>

                <div id="div_comments" class="card my-4 mb-lg-0 " style="display:none;">
                    @if($post->comments->count() > 0)

                        <div class="card shadow">
                            <div class="card-body">
                                <h4 class="card-header mb-2">
                                    Comments
                                </h4>

                                <div id="alert_msg" class="alert alert-success my-2" style="display: none">
                                    Comment deleted success
                                </div>

                                @foreach($post->comments as $comment)
                                    <div id="comment_hide_{{$comment->id}}" class="alert alert-dark  ">

                                        <div class="row ">
                                            <div class="col-2">
                                                <img src="{{asset($comment->user->image)}}" alt="User Image"
                                                     class="img img-thumbnail comment-img"/>
                                            </div>
                                            <div class="col-10">
                                                <div class="comment-content">
                                                    <span class="username"
                                                          style="color: blue">{{$comment->user->name}}</span>
                                                    <p class="comment-text">{{$comment->comment}}</p>
                                                    <span style="margin-left: 320px"
                                                          class="p-2 text-danger">{{$comment->created_at->format('Y-M-d    H-m-a')}}</span>

                                                </div>
                                            </div>
                                        </div>
                                        <a id="delete_comment_{{$comment->id}}" comment_id="{{$comment->id}}"
                                           style="margin-left: 550px" class="my-2 btn btn-danger btn-sm delete_comment"
                                        >Delete <i class="fa fa-trash"></i></a>


                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="card shadow">
                            <div class="card-body">
                                <h4 class="card-header alert alert-primary mb-2">
                                    No Comments !!
                                </h4>


                            </div>
                        </div>
                    @endif
                </div>

            </div>
            <div class="col-lg-5">
                <div class="card mb-4">
                    <a style="margin-left: 350px" href="{{route('admin.posts.index' , ['page'=>request()->page])}}"
                       class="btn btn-primary mt-3 mr-2">Back To Posts</a>

                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Publicher </p>
                            </div>
                            <div class="col-sm-9">
                                <h5 class="text-muted mb-0" style="font-weight: bold">
                                    {{ $post->user->username  ?? $post->admin->name}}
                                    <i class="fa fa-user"></i>
                                </h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">News Title</p>
                            </div>
                            <div class="col-sm-9">
                                <h5 class="text-muted mb-0" style="font-weight: bold">{{$post->title}}</h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Category</p>
                            </div>
                            <div class="col-sm-9">
                                <h5 class="text-muted mb-0" style="font-weight: bold">{{$post->category->name}} <i
                                        class="fa fa-folder"></i></h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Slug</p>
                            </div>
                            <div class="col-sm-9">
                                <h5 class="text-muted mb-0" style="font-weight: bold">{{$post->slug}}</h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Status</p>
                            </div>
                            <div class="col-sm-9">
                                <h5 class="mb-0"
                                    style="@if($post->status == 1) color:green ;font-weight: bold; @else color:red @endif">
                                    {{$post->status == 1 ? 'Active' : 'Not Active'}} <i
                                        class="fa @if($post->status == 1) fa-wifi @else fa-plane @endif "></i></h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-4">
                                <h6 class="mb-0">Comments</h6>
                            </div>
                            <div class="col-sm-8">
                                <h5 class="mb-0"
                                    style="@if($post->comment_able == 1) color:green ;font-weight: bold; @else color:red @endif">
                                    {{$post->comment_able == 1 ?'Active' : 'Not Active'}} <i
                                        class="fa fa-comment"></i></h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">num of views</p>
                            </div>
                            <div class="col-sm-9">
                                <h5 class="text-muted mb-0 " style="font-weight: bold;">
                                    {{$post->num_of_views}}
                                    <i class="fa fa-eye"></i>
                                </h5>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Created At</p>
                            </div>
                            <div class="col-sm-9">
                                <h5 class="text-muted mb-0 " style="font-weight: bold">
                                    {{$post->created_at}}
                                    <i class="fa fa-hourglass-start"></i>
                                </h5>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection


@push('js')
    <script>
        $(document).on('click', '#show_comments', function (e) {
            e.preventDefault();

            if ($('#div_comments').is(':visible')) {
                $('#div_comments').hide();
                $('#show_comments').html(`Show Comments <i class="fa fa-comment"></i>`);
            } else {
                $('#div_comments').show();
                $('#show_comments').html(`Hide Comments <i class="fa fa-comment"></i>`);
            }
        })

        // delete comment by admin
        $(document).on('click', '.delete_comment', function (e) {
            e.preventDefault();

            var commentID = $(this).attr('comment_id');
            $.ajax({
                url: "{{route('admin.posts.comment.delete' ,':commentID')}}".replace(':commentID', commentID),
                type: "GET",

                success: function (data) {
                    $(`#comment_hide_${data.data}`).hide();
                    $(`#alert_msg`).show();

                },
                error: function (data) {

                }

            })


        });

    </script>

@endpush






