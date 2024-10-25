@extends('dashboard.common.app')

@section('title')
    Create Post
@endsection

@push('css')
    <link rel="canonical" href="{{url()->full()}}"/>
@endpush


@section('content')



    <div class="container-fluid">

        <!-- Page Heading -->


    <div class="row" >

        <div class="col-12 text-center">

            <div class="card-body shadow mb-2">
                <a style="margin-left: 1050px" href="{{route('admin.posts.index')}}" class="btn btn-warning">Show Posts</a>
                <h1 class="h3 mb-5 text-gray-800 ">Create Post</h1>
                @include('fronted.common.errors')
                <form action="{{route('admin.posts.store')}}"   enctype="multipart/form-data" method="post">
                    @csrf


                    <div class="form-group row">
                        <div class="col-sm-12 mb-1 ">
                            <input type="text" value="{{ old('title') }}" name="title" class="form-control form-control-range" id="exampleFirstName"
                                   placeholder="Enter Title Post">
                            @error('title')
                            <strong class="text-danger">
                                {{$message}}
                            </strong>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 mb-1 ">
                            <textarea type="text" name="small_desc" cols="2" rows="2"
                                      class="form-control form-control-range" id="exampleFirstName"
                                   placeholder="Enter Small Description">{{ old('small_desc') }}</textarea>

                            @error('small_desc')
                            <strong class="text-danger">
                                {{$message}}
                            </strong>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 mb-1 ">
                            <textarea name="desc" cols="4" rows="4"
                      class="form-control mb-2"  placeholder="What's on your mind?"
                                      id="postContent"
                            >{{ old('desc') }}</textarea>
                            @error('desc')
                            <strong class="text-danger">
                                {{$message}}
                            </strong>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 mb-1 ">
                            <input type="file" name="image[]"  class="form-control form-control-range"
                                        id="postImage"
                                       multiple>
                            @error('image')
                            <strong class="text-danger">
                                {{$message}}
                            </strong>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 mb-1 ">
                            <select name="category_id" id="" class="form-control form-control-range">
                                <option selected disabled value="">select category</option>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <strong class="text-danger">
                                {{$message}}
                            </strong>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <select name="status" id="" class="form-control form-control-file">
                                <option selected disabled value="">status</option>
                                <option value="1">Active</option>
                                <option value="0">Not Active</option>
                            </select>
                            @error('status')
                            <strong class="text-danger">
                                {{$message}}
                            </strong>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <select name="comment_able" id="" class="form-control form-control-file">
                                <option selected disabled value="">Comment Able</option>
                                <option value="on">Active</option>
                                <option value="off">Not Active</option>
                            </select>
                            @error('comment_able')
                            <strong class="text-danger">
                                {{$message}}
                            </strong>
                            @enderror

                        </div>
                    </div>

                    <button type="submit" style="font-size: large;font-family: 'Blabeloo  MagdySoliman'"
                            class="btn btn-primary btn-user btn-block">
                        Create Post
                    </button>
                    <hr>

                </form>

            </div>

        </div>
    </div>

    </div>

@endsection


@push('js')
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
    </script>

@endpush
