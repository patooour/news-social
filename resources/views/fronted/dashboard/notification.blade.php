@extends('fronted.common.app')

@section('title')
Notification
@endsection

@section('breadCrumb')
    @parent

@endsection

@section('content')
    <br> <br>
    <!-- Dashboard Start-->
    <div class="dashboard container">
        <!-- Sidebar -->
        @include('fronted.dashboard.common.sidebar')


        <!-- Main Content -->
        <div class="main-content">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <h2 class="mb-4">Notifications</h2>
                    </div>
                    @if(Auth::user()->unreadNotifications->count()>0)
                        <div class="col-6">
                            <a href="{{route('fronted.dashboard.notification.deleteAll')}}" class="btn btn-danger btn-large"
                               style="margin-left: 250px">Delete All</a>
                        </div>
                    @endif

                </div>
             @forelse(Auth::user()->unreadNotifications()->take(5)->get() as $notify)

                    <a href="{{$notify->data['link']}}?notify={{$notify->id}}">
                        <div class="notification alert alert-info">
                            <strong>{{$notify->data['username']}}</strong>

                            is commented in your post : {{$notify->data['comment']}}
                            <br>
                            {{$notify->created_at ->format('Y-M-D H-s')}}
                            <br>
                            {{$notify->created_at ->diffForHumans()}}
                            <div class="float-right">
                                <button   onclick="if(confirm('want delete'))
                                           {document.getElementById('deleteNotify_{{$notify->id}}').submit() } return false"
                                         class="btn btn-danger btn-sm">Delete</button>
                            </div>
                        </div>
                    </a>

                    <form action="{{route('fronted.dashboard.notification.delete')}}"
                          method="post" id="deleteNotify_{{$notify->id}}">
                        @csrf
                        <input type="hidden" name="notify_id" value="{{$notify->id}}">
                    </form>
                 @empty
                    <div class="notification alert alert-info">
                        <strong>No notifications yet !</strong>

                    </div>
             @endforelse

            </div>
        </div>
    </div>
    <!-- Dashboard End-->
    <br> <br>

@endsection
