@extends('dashboard.auth.common.app')


@section('title')
    Email
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
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" action="{{route('admin.password.email.otp')}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email"  name="email" class="form-control form-control-user"
                                                   id="exampleInputEmail" aria-describedby="emailHelp"
                                                   placeholder="Enter Email Address...">
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Confirm Email
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
