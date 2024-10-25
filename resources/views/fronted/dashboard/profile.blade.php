@extends('fronted.common.app')

@section('title')
Profile
@endsection

@section('breadCrumb')
    @parent

@endsection

@section('content')
    <br><br>
    <!-- Dashboard Start -->
    <div class="dashboard container">
        <!-- Sidebar -->
     @include('fronted.dashboard.common.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            <!-- Profile Section -->
            <section id="profile" class="content-section active">
                <h2>User Profile</h2>
                <div class="user-profile mb-3">
                    <img src="{{asset(Auth::user()->image)}}" alt="User Image" class="profile-img rounded-circle" style="width: 100px; height: 100px;" />
                    <span class="username">{{Auth::user()->name}}</span>
                </div>
                <br>

                <!-- Add Post Section -->
                <form action="{{route('fronted.dashboard.profile.store.post')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <section id="add-post" class="add-post-section mb-5">
                        @include('fronted.common.errors')
                        <h2>Add Post</h2>
                        <form class="post-form p-3 border rounded" enctype="multipart/form-data">
                            <!-- Post Title -->
                            <input name="user_id" type="hidden" class="form-control mb-2" value="{{Auth::user()->id}}" />

                            <input name="title" type="text" id="postTitle" class="form-control mb-2" placeholder="Post Title"   />

                            <!-- Post Content -->
                            <textarea name="small_desc"  class="form-control " rows="3" placeholder="small desc" ></textarea>

                            <textarea name="desc" id="postContent"  class="form-control mb-2" rows="3" placeholder="What's on your mind?" ></textarea>

                            <!-- Image Upload -->
                            <input name="image[]" type="file" id="postImage"  class="form-control mb-2" accept="image/*" multiple />
                            <div class="tn-slider mb-2">
                                <div id="imagePreview" class="slick-slider"></div>
                            </div>

                            <!-- Category Dropdown -->
                            <select name="category_id" id="postCategory"  class="form-select mb-2" >
                                <option value="" selected>Select Category</option>
                                @foreach($categories as $category )
                                    <option value="{{$category->id}}">{{$category->name}}</option>

                                @endforeach

                            </select>

                            <!-- Enable Comments Checkbox -->
                            <div class="form-check mb-2">
                                <input name="comment_able" type="checkbox" class="form-check-input" id="enableComments" />
                                <label class="form-check-label" for="enableComments">
                                    Enable Comments
                                </label>
                            </div>

                            <!-- Post Button -->
                            <button class="btn btn-primary post-btn" type="submit">Post</button>
                        </form>
                    </section>

                </form>

                <!-- Posts Section -->
                <section id="posts" class="posts-section">
                    <h2>Recent Posts</h2>
                    <div class="post-list">
                        <!-- Post Item -->
                        @forelse(Auth::user()->posts as $post)
                            <div class="post-item mb-4 p-3 border rounded">
                                <div class="post-header d-flex align-items-center mb-2">
                                    <img src="{{asset(Auth::user()->image)}}" alt="User Image" class="rounded-circle" style="width: 50px; height: 50px;" />
                                    <div class="ms-3 mx-4">
                                        <h5 class="mb-0">{{Auth::user()->name}}</h5>
                                        <small class="text-muted">{{Auth::user()->created_at}}</small>
                                    </div>
                                </div>
                                <h4 class="post-title">{{$post->title}}</h4>
                                <p class="post-content">{!! $post->desc !!}</p>

                                <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        @foreach($post->images as $index => $image)
                                            <li data-target="#newsCarousel" data-slide-to="{{ $index }}" class="@if($index == 0) active @endif"></li>
                                        @endforeach
                                    </ol>
                                    <div class="carousel-inner">
                                        @foreach($post->images as $index => $image)
                                            <div class="carousel-item @if($index == 0) active @endif">
                                                <img src="{{ asset($image->path) }}" class="d-block w-100" alt="Slide {{ $index + 1 }}" style="width:650px; height: 450px">
                                                <div class="carousel-caption d-none d-md-block">
                                                    <h5>{{ $post->title }}</h5>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- Controls for next/prev -->
                                    <a class="carousel-control-prev" href="#newsCarousel" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#newsCarousel" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>


                                <div class="post-actions d-flex justify-content-between">
                                    <div class="post-stats">
                                        <!-- View Count -->
                                        <span class="me-3">
                                  <i class="fas fa-eye"></i> {{$post->num_of_views}} views
                              </span>
                                    </div>

                                    <div>
                                        <a href="{{route('fronted.dashboard.profile.post.edit',$post->slug)}}"
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="javascript:void(0)"
                                           onclick="if(confirm('want delete'))
                                           {document.getElementById('delete_post_{{$post->slug}}').submit() } return false"
                                           class="btn btn-sm btn-outline-primary delete_btn">
                                            <i class="fas fa-thumbs-up"></i> Delete
                                        </a>


                                        <button id="getComment_{{$post->id}}" class="btn btn-sm btn-outline-secondary getComments"
                                                postId="{{$post->id}}">
                                            <i class="fas fa-comment"></i> Comments
                                        </button>

                                        <button id="hideComment_{{$post->id}}" class="btn btn-sm btn-outline-secondary hideComment"
                                                postId="{{$post->id}}" style="display: none">
                                            <i class="fas fa-comment"></i> hide comments
                                        </button>

                                        <form id="delete_post_{{$post->slug}}"
                                              action="{{route('fronted.dashboard.profile.post.delete',$post->slug)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="slug"  value="{{$post->slug}}">
                                        </form>
                                    </div>
                                </div>

                                <!-- Display Comments -->
                                <div id="display-comments_{{$post->id}}" class="comments" style="display: none;">



                                        <div class="alert alert-info text-center text-capitalize"  style="display: none;">
                                            no comments
                                        </div>

                                    <!-- Add more comments here for demonstration -->
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-info text-center text-capitalize">
                                no posts
                            </div>

                        @endforelse
                        <!-- Add more posts here dynamically -->
                    </div>
                </section>
            </section>
        </div>
    </div>
    <!-- Dashboard End -->
    <br><br>
@endsection

@push('script')
    <script>
        $(function (){
            $("#postImage").fileinput({
                theme: 'fa5',
                maxFileCount: 5,
                showUpload: false
            });

            $("#postContent").summernote({
                height: 100
            });
        });

        // get comments by ajax

        $(document).on('click', '.getComments' , function (e){
            e.preventDefault();
            var postID = $(this).attr('postId');

           $.ajax({
               type: "GET",
               url: "{{ route('fronted.dashboard.profile.comments', ':postID') }}".replace(':postID', postID),
               /*data: "",*/
               success:function (res){
                   $('#display-comments_'+ postID).empty();
                   $.each(res.data , function (index , value){
                       console.log(value)
                       $('#display-comments_'+ postID).append(
                           ` <div class="comment">
                                            <img src="${value.user.imgae}" alt="User Image" class="comment-img" />
                                            <div class="comment-content">
                                                <span class="username">${value.user.username}</span>
                                                <p class="comment-text">${value.comment}</p>
                                            </div>
                                        </div>`
                       ).show()
                   })

                   $('#getComment_'+postID).hide();
                   $('#hideComment_'+postID).show();

               },
               error:function (res){

               },
           })
        });

        $(document).on('click' , '.hideComment' , function (e){
            e.preventDefault();
            var postID = $(this).attr('postId');

            $('#display-comments_'+postID).empty();

            $('#hideComment_'+postID).hide();

            $('#getComment_'+postID).show();



        })
    </script>
@endpush
