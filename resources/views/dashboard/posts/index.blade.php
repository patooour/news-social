@extends('dashboard.common.app')

@section('title')
    Users
@endsection

@push('css')
    <link rel="canonical" href="{{url()->full()}}" />
@endpush


@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Posts</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Posts information</h6>
            </div>

            {{-- search filter--}}
            @include('dashboard.posts.filter.search_filter')
            {{-- search filter--}}
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>id</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>User</th>
                            <th>Status</th>
                            <th>Views</th>
                             {{-- <th>image</th>--}}
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                       @forelse($posts as $k => $post)
                        <tr>
                            <td>{{$k + 1}}</td>
                            <td>{{$post->id}}</td>
                            <td>{{substr($post->title,0,20)}}</td>
                            <td>{{$post->category->name}}</td>
                            <td>{{$post->user->name ??  $post->admin->name }}</td>
                            <td style="@if($post->status == 1) color:green ;font-weight: bold;
                            @else color:red @endif">{{$post->status == 1 ? 'Active' : 'not Active'}}</td>
                            <td>{{$post->num_of_views}}</td>
                            {{--<td>
                                <img src="{{asset($post->image)}}" alt="{{$post->name}}"
                                     style=" height: 150px; width: 100px;">
                            </td>--}}
                            <td>{{$post->created_at}}</td>
                            <td class="text-center ">
                                <a href="javascript:void(0)" onclick="if(confirm('do you want to delete post')) {
                                    document.getElementById('delete_post_{{$post->id}}').submit() } return false
                                " class="btn btn-sm btn-warning"><i class="fa fa-trash"></i></a>
                                <a href="{{route('admin.posts.block' , $post->id)}}" class="  btn btn-sm btn-danger"><i class="fa
                                 @if($post->status == 1) fa-stop @else fa-play @endif"></i></a>
                                <a href="{{route('admin.posts.show' , ['post'=>$post->id , 'page'=>request()->page])}}" class=" btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                @if($post->user_id == null)
                                <a href="{{route('admin.posts.edit' , $post->id)}}" class=" btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                @endif
                            </td>

                        </tr>

                        <form id="delete_post_{{$post->id}}" action="{{route('admin.posts.destroy' ,$post->id )}}" method="post">
                            @csrf
                            @method('DELETE')
                        </form>
                       @empty
                           <tr class="my-1 text-center">
                               <td class="alert alert-info my-1" colspan="8">No Posts !</td>
                           </tr>
                       @endforelse

                        </tbody>

                    </table>
                    {{$posts->appends(request()->input())->links()}}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->


@endsection


@push('js')
    <script>

    </script>

@endpush
