@extends('dashboard.common.app')

@section('title')
    Roles
@endsection

@push('css')
    <link rel="canonical" href="{{url()->full()}}" />
@endpush


@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tables</h1>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Roles information</h6>
                @include('dashboard.authorizations.modal.create')
            </div>

           {{--  search filter
            @include('dashboard.admins.filter.search_filter')
             search filter--}}
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>

                            <th>#</th>
                            <th>Role</th>
                            <th>Authorization</th>
                            <th>Admins related</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                       @forelse($roles as $k => $role)
                        <tr>
                            <td>{{$k + 1}}</td>

                            <td>{{$role->role}}</td>
                            <td>
                                @foreach($role->permissions as $permission)
                                    {{$permission}}  ,
                                @endforeach
                            </td>
                            <td>{{$role->admins->count()}}</td>
                            <td>{{$role->created_at->format('Y-M-d H-m a')}}</td>
                            <td>
                                <a href="javascript:void(0)" onclick="if(confirm('do you want to delete Role')) {
                                    document.getElementById('delete_role_{{$role->id}}').submit() } return false
                                " class=" btn btn-sm btn-warning"><i class="fa fa-trash"></i></a>
{{--
                                <a href="{{route('admin.authorizations.block' , $role->id)}}" class="  btn btn-sm btn-danger"><i class="fa fa-stop"></i></a>
--}}
                                <a href="{{route('admin.authorizations.edit' , $role->id)}}" class=" btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                            </td>

                        </tr>

                        <form id="delete_role_{{$role->id}}" action="{{route('admin.authorizations.destroy' ,$role->id )}}" method="post">
                            @csrf
                            @method('DELETE')
                        </form>
                       @empty
                           <tr class="my-1 text-center">
                               <td class="alert alert-info my-1" colspan="8">No Roles !</td>
                           </tr>
                       @endforelse

                        </tbody>

                    </table>
{{--
                    {{$roles->appends(request()->input())->links()}}
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
