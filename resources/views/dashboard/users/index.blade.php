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
        <h1 class="h3 mb-2 text-gray-800">Tables</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank"
                                                                       href="https://datatables.net">official DataTables documentation</a>.</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Users information</h6>
            </div>

            {{-- search filter--}}
            @include('dashboard.users.filter.search_filter')
            {{-- search filter--}}
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Country</th>
                           {{-- <th>image</th>--}}
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                       @forelse($users as $k => $user)
                        <tr>
                            <td>{{$k + 1}}</td>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td style="@if($user->status == 1) color:green ;font-weight: bold; @else color:red @endif">{{$user->status == 1 ? 'Active' : 'not Active'}}</td>
                            <td>{{$user->country}}</td>
                            {{--<td>
                                <img src="{{asset($user->image)}}" alt="{{$user->name}}"
                                     style=" height: 150px; width: 100px;">
                            </td>--}}
                            <td>{{$user->created_at}}</td>
                            <td>
                                <a href="javascript:void(0)" onclick="if(confirm('do you want to delete user')) {
                                    document.getElementById('delete_user_{{$user->id}}').submit() } return false
                                " class=" btn btn-sm btn-warning"><i class="fa fa-trash"></i></a>
                                <a href="{{route('admin.users.block' , $user->id)}}" class="  btn btn-sm btn-danger"><i class="fa @if($user->status == 1) fa-stop @else fa-play @endif"></i></a>
                                <a href="{{route('admin.users.show' , $user->id)}}" class=" btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                            </td>

                        </tr>

                        <form id="delete_user_{{$user->id}}" action="{{route('admin.users.destroy' ,$user->id )}}" method="post">
                            @csrf
                            @method('DELETE')
                        </form>
                       @empty
                           <tr class="my-1 text-center">
                               <td class="alert alert-info my-1" colspan="8">No Users !</td>
                           </tr>
                       @endforelse

                        </tbody>

                    </table>
                    {{$users->appends(request()->input())->links()}}
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
