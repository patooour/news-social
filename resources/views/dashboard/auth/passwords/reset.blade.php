@extends('dashboard.auth.common.app')


@section('title')
    Reset
@endsection

@section('content')

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9 ">

                <div class="card o-hidden border-0 shadow-lg my-5 ">
                    <div class="card-body p-0 ">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image text-center">
                                <img src="" alt="">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Enter New Password!</h1>
                                    </div>
                                    <form class="user" action="{{route('admin.password.update')}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input type="hidden"  name="email" class="form-control form-control-user"
                                                   id="exampleInputEmail" aria-describedby="emailHelp"
                                                   value="{{$email}}">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                   id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password_confirmation" class="form-control form-control-user"
                                                   id="exampleInputPassword" placeholder="password_confirmation">
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Reset Password
                                        </button>
                                        <br>
                                        @include('fronted.common.errors')

                                    </form>
                                    <hr>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

@endsection
