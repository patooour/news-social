@extends('dashboard.common.app')

@section('title')
    Show Contact Details
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
            {{--    <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="{{asset($contact->image)}}" alt="avatar"
                                 class="rounded-circle img-fluid" style="width: 150px;">
                            <h5 class="my-3">{{$contact->name}}</h5>
                            <p class="text-muted mb-1">{{$contact->email}}</p>
                            <p class="text-muted mb-4">{{$contact->street}}, {{$contact->city}}, {{$contact->country}}</p>
                            <div class="d-flex justify-content-center mb-2">

                                <a  href="{{route('admin.users.block' , $contact->id)}}"
                                   class="btn btn-warning"
                                >@if($contact->status == 1) Block  @else Activate @endif</a>

                                <a  href="javascript:void(0)" onclick="if(confirm('do you want to delete user')) {
                                    document.getElementById('delete_user_form_{{$contact->id}}').submit() } return false
                                " id="delete_user_{{$contact->id}}"
                                    class="btn btn-danger mx-1">Delete</a>

                                <form id="delete_user_form_{{$contact->id}}" action="{{route('admin.users.destroy' , $contact->id )}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
                    </div>
                    --}}{{--card emails icons --}}{{--
                   --}}{{-- <div class="card mb-4 mb-lg-0">
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
                    </div>--}}{{--
                    --}}{{--card emails icons --}}{{--
                </div>--}}
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h5 class="mb-0" style="color:#3b5998">Full Name</h5>
                                </div>
                                <div class="col-sm-9">
                                    <h5 class="text-muted mb-0">{{$contact->name}}</h5>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0" style="color:#3b5998">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <h5 class="text-info mb-0">{{$contact->email}}</h5>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h5 class="mb-0" style="color:#3b5998">Title</h5>
                                </div>
                                <div class="col-sm-9">
                                    <h5 class="text-muted mb-0">{{$contact->title}}</h5>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h5 class="mb-0" style="color:#3b5998">Phone</h5>
                                </div>
                                <div class="col-sm-9">
                                    <h5 class="text-muted mb-0">(+20) {{$contact->phone}}</h5>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h5 class="mb-0" style="color:#3b5998">Body</h5>
                                </div>
                                <div class="col-sm-9">
                                    <h5 class="text-danger  mb-0">{{$contact->body}}</h5>
                                </div>
                            </div>

                            <hr>
                            <div class="d-flex justify-content-center mb-2">

                                <a  href="mailto:{{$contact->email}}?subject=Re:{{urlencode($contact->title)}}"
                                    class="btn btn-info"
                                >Reply <i class="fa fa-reply"></i></a>

                                <a  href="javascript:void(0)" onclick="if(confirm('do you want to delete user')) {
                                    document.getElementById('delete_contact_form_{{$contact->id}}').submit() } return false
                                " id="delete_contact_{{$contact->id}}"
                                    class="btn btn-danger mx-1">Delete <i class="fa fa-trash"></i></a>

                                <form id="delete_contact_form_{{$contact->id}}" action="{{route('admin.contacts.destroy' , $contact->id )}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                </form>
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
