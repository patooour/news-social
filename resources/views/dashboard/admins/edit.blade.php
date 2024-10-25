@extends('dashboard.common.app')

@section('title')
    Edit Admin
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
                    <a style="margin-left: 720px" href="{{route('admin.admins.index')}}" class="btn btn-info mt-1 mr-2">Back To Admins</a>

                    <h1 class="h3 mb-3 text-gray-800 ">Edit Admin</h1>
                    <form action="{{route('admin.admins.update' , $admin->id)}}" class="user mb-3" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <input type="text" name="name" class="form-control form-control-range"
                                       id="exampleFirstName"
                                       value="{{$admin->name}}"
                                       placeholder="Enter name of Admin">
                                @error('name')
                                <strong class="text-danger">
                                    {{$message}}
                                </strong>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input type="email" name="email" class="form-control form-control-range"
                                       id="exampleLastName"
                                       value="{{$admin->email}}"
                                       placeholder="Enter email of admin">
                                @error('email')
                                <strong class="text-danger">
                                    {{$message}}
                                </strong>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <input type="text" name="username" class="form-control form-control-range"
                                       id="exampleFirstName"
                                       value="{{$admin->username}}"
                                       placeholder="Enter Username Of Admin">
                                @error('username')
                                <strong class="text-danger">
                                    {{$message}}
                                </strong>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <select name="status" id="" class="form-control form-control-file">
                                    <option selected disabled value="">status</option>
                                    <option @selected($admin->status == 1) value="1">Active</option>
                                    <option @selected($admin->status == 0) value="0">Not Active</option>
                                </select>
                                @error('status')
                                <strong class="text-danger">
                                    {{$message}}
                                </strong>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <select name="role_id" id="" class="form-control form-control-file">
                                    <option selected disabled value="">Select Role Permission</option>
                                    @forelse($roles as $role)
                                    <option  @selected($admin->role_id == $role->id) value="{{$role->id}}">{{$role->role}}</option>
                                    @empty
                                        <option selected disabled value="">No Roles</option>

                                    @endforelse
                                </select>
                                @error('role_id')
                                <strong class="text-danger">
                                    {{$message}}
                                </strong>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <input type="password" name="password" class="form-control form-control-range"
                                       id="exampleInputPassword" placeholder="Enter Password">
                                @error('password')
                                <strong class="text-danger">
                                    {{$message}}
                                </strong>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">

                            <div class="col-sm-12">
                                <input type="password" name="password_confirmation"
                                       class="form-control form-control-range"
                                       id="exampleRepeatPassword" placeholder="Enter password confirmation ">
                                @error('password_confirmation')
                                <strong class="text-danger">
                                    {{$message}}
                                </strong>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" style="font-size: large;font-family: 'Blabeloo  MagdySoliman'"
                                class="btn btn-primary btn-user btn-block">
                            Edit Admin
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
