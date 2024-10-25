@extends('dashboard.common.app')

@section('title')
    Show User Details
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
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="{{asset($user->image)}}" alt="avatar"
                                 class="rounded-circle img-fluid" style="width: 150px;">
                            <h5 class="my-3">{{$user->name}}</h5>
                            <p class="text-muted mb-1">{{$user->email}}</p>
                            <p class="text-muted mb-4">{{$user->street}}, {{$user->city}}, {{$user->country}}</p>
                            <div class="d-flex justify-content-center mb-2">

                                <a  href="{{route('admin.users.block' , $user->id)}}"
                                   class="btn btn-warning"
                                >@if($user->status == 1) Block  @else Activate @endif</a>

                                <a  href="javascript:void(0)" onclick="if(confirm('do you want to delete user')) {
                                    document.getElementById('delete_user_form_{{$user->id}}').submit() } return false
                                " id="delete_user_{{$user->id}}"
                                    class="btn btn-danger mx-1">Delete</a>

                                <form id="delete_user_form_{{$user->id}}" action="{{route('admin.users.destroy' , $user->id )}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
                    </div>
                    {{--card emails icons --}}
                   {{-- <div class="card mb-4 mb-lg-0">
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush rounded-3">
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fas fa-globe fa-lg text-warning"></i>
                                    <p class="mb-0">https://mdbootstrap.com</p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fab fa-github fa-lg text-body"></i>
                                    <p class="mb-0">mdbootstrap</p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                                    <p class="mb-0">@mdbootstrap</p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                                    <p class="mb-0">mdbootstrap</p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                                    <p class="mb-0">mdbootstrap</p>
                                </li>
                            </ul>
                        </div>
                    </div>--}}
                    {{--card emails icons --}}
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Full Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$user->name}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$user->email}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Phone</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">(+20) {{$user->phone}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Username</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$user->username}}</p>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Address</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$user->street}}, {{$user->city}}, {{$user->country}}</p>
                                </div>

                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Status</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class=" mb-0 "
                                       style="@if($user->status == 1) color:green ;font-weight: bold; @else color:red @endif">
                                        {{$user->status == 1 ? 'Active' : 'Not Active'}}</p>
                                </div>

                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email Verify</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class=" mb-0"
                                       style="@if($user->email_verified_at == null) color:red;  @else color:green ;font-weight: bold; @endif">
                                        {{$user->email_verified_at == null ? 'Not Verify' : 'Verified'}}
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection


@push('js')
    <script>

    </script>

@endpush
