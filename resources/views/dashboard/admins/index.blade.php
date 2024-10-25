@extends('dashboard.common.app')

@section('title')
    Admins
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
            @include('dashboard.admins.filter.search_filter')
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
                            <th>UserName</th>
                            <th>Status</th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                       @forelse($admins as $k => $admin)
                        <tr>
                            <td>{{$k + 1}}</td>
                            <td>{{$admin->id}}</td>
                            <td>{{$admin->name}}</td>
                            <td>{{$admin->email}}</td>
                            <td>{{$admin->username}}</td>
                            <td style="@if($admin->status == 1) color:green ;font-weight: bold;
                            @else color:red @endif">{{$admin->status == 1 ? 'Active' : 'not Active'}}</td>
                            <td>{{$admin->role->role}}</td>
                            <td>{{$admin->created_at->format('Y-M-D H-m a')}}</td>
                            <td>
                                <a href="javascript:void(0)" onclick="if(confirm('do you want to delete admin')) {
                                    document.getElementById('delete_user_{{$admin->id}}').submit() } return false
                                " class=" btn btn-sm btn-warning"><i class="fa fa-trash"></i></a>
                                <a href="{{route('admin.admins.block' , $admin->id)}}" class="  btn btn-sm btn-danger"><i class="fa fa-stop"></i></a>
                                <a href="{{route('admin.admins.show' , $admin->id)}}" class=" btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                <a href="{{route('admin.admins.edit' , $admin->id)}}" class=" btn btn-sm btn-info"><i class="fa fa-edit"></i></a>

                            </td>

                        </tr>

                        <form id="delete_user_{{$admin->id}}" action="{{route('admin.admins.destroy' ,$admin->id )}}" method="post">
                            @csrf
                            @method('DELETE')
                        </form>
                       @empty
                           <tr class="my-1 text-center">
                               <td class="alert alert-info my-1" colspan="9 ">No <Admins></Admins> !</td>
                           </tr>
                       @endforelse

                        </tbody>

                    </table>
{{--
                    {{$admins->appends(request()->input())->links()}}
--}}
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
