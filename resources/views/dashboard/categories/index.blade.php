@extends('dashboard.common.app')

@section('title')
    categories
@endsection

@push('css')
    <link rel="canonical" href="{{url()->full()}}"/>
@endpush


@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tables</h1>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">categories information</h6>
            </div>
            <div class="row">
                <div class="col-3  mt-3" style="margin-left: 22px">
                    {{-- modal add new category--}}
                    <!-- Button trigger modal -->
                    @include('dashboard.categories.create')

                </div>

            </div>
            {{-- search filter--}}
            @include('dashboard.categories.filter.search_filter')
            {{-- search filter--}}
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>id</th>
                            <th>Name</th>
                            <th>Describtion</th>
                            <th>Status</th>
                            <th>Posts Count</th>
                            {{-- <th>image</th>--}}
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($categories as $k => $category)
                            <tr>
                                <td>{{$k + 1}}</td>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{substr($category->small_desc ,0,15 )}} ...</td>
                                <td style="@if($category->status == 1) color:green ;font-weight: bold; @else color:red @endif">{{$category->status == 1 ? 'Active' : 'not Active'}}</td>
                                {{--<td>
                                    <img src="{{asset($category->image)}}" alt="{{$category->name}}"
                                         style=" height: 150px; width: 100px;">
                                </td>--}}
                                <td>{{$category->posts_count}}</td>
                                <td>{{$category->created_at}}</td>
                                <td>

                                    <a href="javascript:void(0)" onclick="if(confirm('do you want to delete user')) {
                                    document.getElementById('delete_user_{{$category->id}}').submit() } return false
                                " class=" btn btn-sm btn-warning"><i class="fa fa-trash"></i></a>

                                    <a href="{{route('admin.categories.block' , $category->id)}}"
                                       class="  btn btn-sm btn-danger"><i class="fa @if($category->status == 1)
                                    fa-stop @else fa-play @endif"></i></a>

                                    <a data-toggle="modal" data-target="#editCategory_{{$category->id}}"
                                       href="{{route('admin.categories.show' , $category->id)}}"
                                       class=" btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                </td>

                            </tr>

                            <form id="delete_user_{{$category->id}}"
                                  action="{{route('admin.categories.destroy' ,$category->id )}}" method="post">
                                @csrf
                                @method('DELETE')
                            </form>

                            {{--start edit modal --}}
                          @include('dashboard.categories.edit')

                            {{--end edit modal--}}

                        @empty
                            <tr class="my-1 text-center">
                                <td class="alert alert-info my-1" colspan="8">No categories !</td>
                            </tr>
                        @endforelse

                        </tbody>
                        {{  $categories->appends(request()->input())->links() }}
                    </table>
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
