@extends('dashboard.auth.common.app')


@section('title')
    Confirm
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
                                        <h1 class="h4 text-gray-900 mb-4">Enter your verification code</h1>
                                    </div>
                                    <form class="user" action="{{route('admin.password.verify.otp')}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input type="hidden"  name="email" class="form-control form-control-user"
                                                   id="exampleInputEmail" aria-describedby="emailHelp"
                                                   value="{{$email}}">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="token" class="form-control form-control-user"
                                                   id="exampleInputPassword" placeholder="token">
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                           Check Token
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
