@extends('dashboard.common.app')

@section('title')
    Create User
@endsection

@push('css')
    <link rel="canonical" href="{{url()->full()}}"/>
@endpush


@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->


    <div class="row " style="margin-left: 130px">

        <div class="col-10 text-center">

            <div class="card-body shadow mb-2">
                <h1 class="h3 mb-5 text-gray-800 ">Create User</h1>
                <form action="{{route('admin.users.store')}}"  class="user" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" name="name" class="form-control form-control-user" id="exampleFirstName"
                                   placeholder="Name">
                            @error('name')
                            <strong class="text-danger">
                                {{$message}}
                            </strong>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <input type="email"  name="email" class="form-control form-control-user" id="exampleLastName"
                                   placeholder="Email">
                            @error('email')
                            <strong class="text-danger">
                                {{$message}}
                            </strong>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" name="username" class="form-control form-control-user" id="exampleFirstName"
                                   placeholder="Username">
                            @error('username')
                            <strong class="text-danger">
                                {{$message}}
                            </strong>
                            @enderror
                        </div>
                        <div class="col-sm-6">

                            <input type="text" name="phone" class="form-control form-control-user" id="exampleLastName"
                                   placeholder="Phone">
                            @error('phone')
                            <strong class="text-danger">
                                {{$message}}
                            </strong>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" name="country" class="form-control form-control-user" id="exampleFirstName"
                                   placeholder="country">
                            @error('country')
                            <strong class="text-danger">
                                {{$message}}
                            </strong>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="city" class="form-control form-control-user" id="exampleLastName"
                                   placeholder="City">
                            @error('city')
                            <strong class="text-danger">
                                {{$message}}
                            </strong>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" name="street" class="form-control form-control-user" id="exampleFirstName"
                                   placeholder="Street">
                            @error('street')
                            <strong class="text-danger">
                                {{$message}}
                            </strong>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <input type="file" name="image" class="form-control form-control-range"
                                   placeholder="image">
                            @error('image')
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
                            <select name="email_verified_at" id="" class="form-control form-control-file">
                                <option selected disabled value="" >Email Verified </option>
                                <option value="1">Active</option>
                                <option value="0">Not Active</option>
                            </select>
                            @error('email_verified_at')
                            <strong class="text-danger">
                                {{$message}}
                            </strong>
                            @enderror

                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="password" name="password" class="form-control form-control-user"
                                   id="exampleInputPassword" placeholder="Password">
                            @error('password')
                            <strong class="text-danger">
                                {{$message}}
                            </strong>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <input type="password" name="password_confirmation" class="form-control form-control-user"
                                   id="exampleRepeatPassword" placeholder="password confirmation ">
                            @error('password_confirmation')
                            <strong class="text-danger">
                                {{$message}}
                            </strong>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" style="font-size: large;font-family: 'Blabeloo  MagdySoliman'"
                            class="btn btn-primary btn-user btn-block">
                        Create User
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

    </script>

@endpush
