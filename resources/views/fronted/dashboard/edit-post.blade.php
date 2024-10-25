@extends('fronted.common.app')

@section('title')
Edit | {{$post->title}}
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
        <div class="main-content col-md-9">
            <!-- Show/Edit Post Section -->
            <form action="{{route('fronted.dashboard.profile.post.update',$post->slug)}}"
                  method="post" enctype="multipart/form-data" >
                @csrf
                @method('PUT')
            <section id="posts-section" class="posts-section">
                <h2>Your Posts</h2>

                @include('fronted.common.errors')
                    <ul class="list-unstyled user-posts">
                        <!-- Example of a Post Item -->
                        <li class="post-item">
                            <!-- Editable Title -->
                            <input type="text" class="form-control mb-2 post-title" name="title" value="{{$post->title}}"  />

                            <textarea  name="small_desc" class="form-control mb-2 post-content"
                            >{{$post->small_desc ?? "" }}
                             </textarea>
                            <input type="hidden"  name="post_id" value="{{$post->id}}"  />

                            <!-- Editable Content -->
                            <textarea id="postContent" name="desc" class="form-control mb-2 post-content" readonly>
                            {!! $post->desc !!}
                        </textarea>

                            <!-- Post Images Slider -->
                            {{--<div class="tn-slider">
                                <div class="slick-slider edit-slider" id="postImages">
                                    <!-- Existing Images -->
                                </div>
                            </div>--}}

                            <!-- Image Upload Input for Editing -->
                            <input type="file"  id="post-image"
                                   class="form-control mt-2 edit-post-image"
                                   name="image[]"
                                   accept="image/*" multiple />

                            <!-- Editable Category Dropdown -->
                            <select class="form-control mb-2 post-category" name="category_id">
                                @foreach($categories as $category)
                                    <option  value="{{$category->id}}"
                                        @selected($category->id == $post->category_id)>
                                        {{$category->name}}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Editable Enable Comments Checkbox -->
                            <div class="form-check mb-2">
                                <input  class="form-check-input enable-comments"
                                        @checked($post->comment_able == 1)
                                        name="comment_able"
                                        type="checkbox" />
                                <label class="form-check-label">
                                    Enable Comments
                                </label>
                            </div>

                            <!-- Post Meta: Views and Comments -->
                            <div class="post-meta d-flex justify-content-between">
                                <span class="views">
                                  {{$post->num_of_views}}   <i class="fas fa-eye-comment"></i>
                                </span>
                                <span class="post-comments">
                                 {{$post->comments->count()}}  <i class="fas fa-comment"></i>
                                </span>
                            </div>

                            <!-- Post Actions -->
                            <div class="post-actions mt-2">
                                <button type="submit" class="btn btn-success save-post-btn ">
                                    Save
                                </button>
                                <a class="btn btn-secondary cancel-edit-btn "
                                        href="{{route('fronted.dashboard.profile')}}">
                                    Cancel
                                </a>
                            </div>

                        </li>
                        <!-- Additional posts will be added dynamically -->
                    </ul>


            </section>
            </form>
        </div>
        </div>
    <!-- Dashboard End -->
    <br><br>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $("#post-image").fileinput({
                theme: 'fa5',
                allowedFileTypes: ['image'],
                maxFileCount: 5,

                showUpload: false,
                initialPreviewAsData: true,
                initialPreview:[
                    @if($post->images->count() > 0)
                        @foreach($post->images as $image)
                        "{{ asset($image->path) }}",
                    @endforeach
                    @endif
                ],
                initialPreviewConfig: [
                        @if($post->images->count() > 0)
                        @foreach($post->images as $image)
                    {
                        caption: '{{$image->path}}',  // اسم الصورة
                        width: '120px',
                        url: '{{route('fronted.dashboard.profile.image.delete',
                        [$image->id ,'_token'=> csrf_token()])
                        }}',  // رابط حذف الصورة
                        key: {{ $image->id }},
                    },
                    @endforeach
                    @endif
                ],

            });


            $("#postContent").summernote({
                height: 100
            });
        });



    </script>
@endpush
