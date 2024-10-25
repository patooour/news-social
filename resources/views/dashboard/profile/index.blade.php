@extends('dashboard.common.app')

@section('title')
    Profile Admin
@endsection

@section('breadCrumb')
    @parent

@endsection

@push('css')
    <link rel="canonical" href="{{url()->full()}}"/>
@endpush


@section('content')

    <section style="">
        <div class="container ">
            <div class="row my-1">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="{{asset('assets/admin/img/undraw_profile.svg')}}" alt="avatar"
                                 class="rounded-circle img-fluid" style="width: 150px;">
                            <h5 class="my-3">{{auth('admin')->user()->name}}</h5>
                            <p class="text-muted mb-1">{{auth('admin')->user()->username}}</p>
                            <p class="text-muted mb-1">{{auth('admin')->user()->email}}</p>
                            <p class=" mb-1"
                               style="@if(auth('admin')->user()->status  == 1) color:green ; font-weight:bold; @else color:red @endif"
                            >{{auth('admin')->user()->status  == 1 ? 'Active' : 'not Active'}}</p>
                            <div class="d-flex justify-content-center mb-2">

                            </div>
                        </div>
                    </div>
{{--
                    card emails icons
--}}

                     <div id="forgetPassword_form" class="card mb-4 mb-lg-0 " style="display: none">
                         <div class="card-body p-0">
                             <form action="{{route('admin.profile.verifyOtp')}}" method="post" class="form-group mt-4 p-4">
                                 @csrf
                                 <input type="hidden" name="email" value="{{auth('admin')->user()->email}}">

                                 <input class="form-control p-4" type="text" name="otp"
                                        placeholder="Enter Otp Sent To Your Email">
                                 <div id="errorMsg" style="display:none;" class="alert alert-danger my-2">

                                 </div>

                                 @include('dashboard.profile.passwords.create')
                             </form>
                         </div>
                     </div>
{{--
                    card emails icons
--}}
                </div>

                <div class="col-lg-8">
                    <div class="card mb-4">
                        <form action="{{route('admin.profile.update' , auth('admin')->user()->id ) }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Full Name</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input name="name" class="form-control" type="text" value="{{auth('admin')->user()->name}}">
                                        @error('name')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Email</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input name="email" class="form-control" type="text"
                                               value="{{auth('admin')->user()->email}}"></div>
                                    @error('email')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Username</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input name="username" class="form-control" type="text"
                                               value="{{auth('admin')->user()->username}}"></div>
                                    @error('username')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <p class="mb-0">Current Password</p>
                                    </div>
                                    <div class="col-sm-8">
                                        <input name="current_password" class="form-control" type="password"></div>
                                    @error('current_password')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <p class="mb-0">Password</p>
                                    </div>
                                    <div class="col-sm-8">
                                        <input name="password" class="form-control" type="password"></div>
                                    @error('password')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Permission</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="mb-0 text-capitalize" style="color:green;font-weight: bold;">{{auth('admin')->user()->role->role}}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Status</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class=" mb-0 "
                                           style="@if(auth('admin')->user()->status == 1) color:green ;font-weight: bold; @else color:red @endif">
                                            {{auth('admin')->user()->status == 1 ? 'Active' : 'Not Active'}}</p>
                                    </div>

                                </div>
                                <hr>
                                <button type="submit" class="btn btn-primary">Update Setting</button>
                                <a id="forgetPassword"  class="btn btn-warning">Forget Password</a>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
        </div>
    </section>

@endsection


@push('js')
    <script>
        $(document).on('click' , '#forgetPassword' , function (e){
            e.preventDefault();


            $.ajax({
                url:"{{route('admin.profile.sentOtp', auth('admin')->user()->email)}}",
                type:"get",
                success:function (data){

                    $('#forgetPassword_form').show();
                },
                error: function(data) {
                    $('#errorMsg').text(data.msg[0]).show();
                }

            })
        })
    </script>

@endpush
