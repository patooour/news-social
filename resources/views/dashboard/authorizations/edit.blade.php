@extends('dashboard.common.app')

@section('title')
    Edit Roles
@endsection

@push('css')
    <link rel="canonical" href="{{url()->full()}}"/>
@endpush


@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->


        <div class="row " style="margin-left: 130px">

            <div class="col-10 text-center">

                <div class="card-body shadow ">
                    <a style="margin-left: 720px" href="{{route('admin.authorizations.index')}}" class="btn btn-info mt-1 mr-2">Back To Roles</a>

                    <h1 class="h3 mb-3 text-gray-800 ">Update Role {{$auth->role}}</h1>
                    @include('fronted.common.errors')
                    <form action="{{route('admin.authorizations.update',$auth->id )}}" class="user mb-3" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <input type="text" name="role" class="form-control form-control-range"
                                       id="exampleFirstName"
                                       value="{{$auth->role}}"
                                       placeholder="Enter Role Name">
                                @error('role')
                                <strong class="text-danger">
                                    {{$message}}
                                </strong>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-5">
                            @foreach(config('authorization.permissions') as $key=>$value)
                                <div class="col-sm-2 mt-4">

                                    {{$value}} <input @checked(in_array($key , $auth->permissions)) value="{{$key}}" type="checkbox" name="permissions[]"   >

                                </div>
                            @endforeach
                        </div>

                        <button type="submit" style="font-size: large;font-family: 'Blabeloo  MagdySoliman'"
                                class="btn btn-primary btn-user btn-block mt-5">
                            Update Role
                        </button>


                    </form>

                </div>

            </div>
        </div>

    </div>

@endsection


@push('js')
    <script>

    </script>

@endpush
