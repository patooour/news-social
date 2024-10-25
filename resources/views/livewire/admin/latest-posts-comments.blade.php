<div class="row">

    <!-- table posts  -->
    <div class="col-lg-5 mb-4">

        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Latest Posts</h6>
            </div>
            <div class="card-body table-container">
                <div class="table-responsive small-table">
                    <table class="table table-bordered" id="dataTable" >
                        <thead>
                        <tr>
                            <th>title</th>
                            <th>category</th>
                            <th>comments</th>
                            <th>status</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($latest_posts as $k => $post)
                            <tr>
                                <td><a href="{{route('admin.posts.show',$post->id)}}">
                                        {{$post->title}}
                                    </a></td>
                                <td>{{$post->category->name}}</td>
                                <td>{{$post->comments_count}}</td>
                                <td style="@if($post->status == 1) color:green ; font-weight: bold @endif">{{$post->status ==1 ? 'Active' :'Not Active'}}</td>

                            </tr>


                        @empty
                            <tr class="my-1 text-center">
                                <td class="alert alert-info my-1" colspan="8">No Posts !</td>
                            </tr>
                        @endforelse

                        </tbody>

                    </table>

                </div>
            </div>
        </div>


    </div>

    <!-- table comments -->
    <div class="col-lg-7 mb-4">

        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Latest Comments</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive large-table">
                    <table class="table table-bordered" id="dataTable" >
                        <thead>
                        <tr>
                            <th>user name</th>
                            <th>post name</th>
                            <th>comment</th>
                            <th>status</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($latest_comments as $k => $comment)
                            <tr>
                                <td>{{$comment->user->name}}</td>
                                <td>
                                    <a href="{{route('admin.posts.show',$comment->post->id)}}">
                                    {{\Illuminate\Support\Str::limit($comment->post->title , 20)}}
                                    </a>
                                </td>
                                <td>{{\Illuminate\Support\Str::limit($comment->comment , 50)}}</td>
                                <td style="@if($comment->status == 1) color:green; font-weight: bold @else color:red; @endif">{{$comment->status ==1 ? 'Active' :'Not Active'}}</td>

                            </tr>


                        @empty
                            <tr class="my-1 text-center">
                                <td class="alert alert-info my-1" colspan="8">No Posts !</td>
                            </tr>
                        @endforelse
                        </tbody>

                    </table>

                </div>
            </div>
        </div>


    </div>

</div>
