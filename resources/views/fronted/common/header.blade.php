
<!-- Top Bar Start -->
<div class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="tb-contact">
                    <p><i class="fas fa-envelope"></i>{{$settings->email}}</p>
                    <p><i class="fas fa-phone-alt"></i>{{$settings->phone}}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="tb-menu">
                   @if(\Illuminate\Support\Facades\Auth::check())
                        <a href="javascript:void(0)"  onclick="if (confirm('want logout')) {
                            document.getElementById('formLogout').submit()
                        } return false">logout</a>
                    @else
                        <a href="{{route('login')}}">login</a>
                        <a href="{{route('register')}}">register</a>
                   @endif


                </div>
            </div>
            <form id="formLogout" action="{{route('logout')}}" method="post">
                @csrf
            </form>
        </div>
    </div>
</div>
<!-- Top Bar Start -->

<!-- Brand Start -->
<div class="brand">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4">
                <div class="b-logo">
                    <a href="index.html">
                        <img src="{{asset($settings->logo)}}" alt="Logo" />
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-4">
                <div class="b-ads">
                    <a href="https://htmlcodex.com">
                        <img src="{{asset($settings->favicon)}}" alt="Ads" />
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <form action="{{route('fronted.search')}}" method="post">
                    @csrf
                    <div class="b-search">
                        <input type="text" placeholder="Search" name="search"/>

                        <button><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Brand End -->

<!-- Nav Bar Start -->
<div class="nav-bar">
    <div class="container">
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <a href="#" class="navbar-brand">MENU</a>
            <button
                type="button"
                class="navbar-toggler"
                data-toggle="collapse"
                data-target="#navbarCollapse"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div
                class="collapse navbar-collapse justify-content-between"
                id="navbarCollapse"
            >
                <div class="navbar-nav mr-auto">
                    <a href="{{route('fronted.index')}}" class="nav-item nav-link active">Home</a>
                    <div class="nav-item dropdown">
                        <a
                            href="#"
                            class="nav-link dropdown-toggle"
                            data-toggle="dropdown"
                        >All category </a
                        >
                        <div class="dropdown-menu">
                         @foreach($categories as $category)
                            <a href="{{route('fronted.category.posts',$category->slug)}}" title="{{$category->name}}" class="dropdown-item">{{$category->name}}</a>
                            @endforeach
                        </div>
                    </div>
                    <a href="{{route('fronted.contactUs')}}" class="nav-item nav-link">Contact Us</a>
                    @auth
                        <a href="{{route('fronted.dashboard.profile')}}" class="nav-item nav-link">Account</a>

                    @endauth
                </div>
                <div class="social ml-auto">
                    @auth
                    {{-- --}}
                    <!-- Notification Dropdown -->
                    <a href="#" class="nav-link dropdown-toggle"
                       id="notificationDropdown" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell"></i>

                        <span id="num_Notifi" class="badge badge-danger">{{Auth::user()->unreadNotifications->count() }}</span>

                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown" style="width: 300px;">
                        <h6 class="dropdown-header">Notifications</h6>

                     @forelse(Auth::user()->unreadNotifications()->take(5)->get() as $notify)
                            <div id="push_notification">

                                <div class="dropdown-item d-flex justify-content-between align-items-center">
                                    <span class="dropdown-item"> new comment by: {{$notify->data['username']}}</span>

                                    <a href="{{ route('fronted.post.show' ,$notify->data['post_slug']) }}?notify={{$notify->id}}  "><i class="fas fa-eye"></i></a>
                                </div>

                            </div>
                        @empty
                     @endforelse

                        <!-- <div class="dropdown-item text-center">No notifications</div>  -->

                    </div>

                    {{----}}
                    @endauth
                    <a href="{{$settings->twitter}}"><i class="fab fa-twitter"></i></a>
                    <a href="{{$settings->facebook}}"><i class="fab fa-facebook-f"></i></a>
                    <a href="{{$settings->instagram}}"><i class="fab fa-instagram"></i></a>
                    <a href="{{$settings->youtube}}"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Nav Bar End -->

