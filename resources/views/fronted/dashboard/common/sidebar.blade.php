<!-- Sidebar -->
    <aside class="col-md-3 nav-sticky dashboard-sidebar">
        <!-- User Info Section -->
        <div class="user-info text-center p-3">
            <img src="{{asset(Auth::user()->image)}}" alt="User Image" class="rounded-circle mb-2"
                 style="width: 80px; height: 80px; object-fit: cover" />
            <h5 class="mb-0" style="color: #ff6f61">{{Auth::user()->name}}</h5>
        </div>

        <!-- Sidebar Menu -->
        <div class="list-group profile-sidebar-menu">
            <a href="{{route('fronted.dashboard.profile')}}"
               class="list-group-item list-group-item-action menu-item
                {{ request()->routeIs('fronted.dashboard.profile')  ? 'active' : '' }}" data-section="profile">
                <i class="fas fa-user"></i> Profile
            </a>
            <a href="{{route('fronted.dashboard.notification')}}"
               class="list-group-item list-group-item-action menu-item
                {{ request()->routeIs('fronted.dashboard.notification') ? 'active' : '' }}" data-section="notifications">
                <i class="fas fa-bell"></i> Notifications
            </a>
            <a href="{{route('fronted.dashboard.setting')}}"
               class="list-group-item list-group-item-action  menu-item
                {{ $setting_active ?? ''}}
                " data-section="settings">
                <i class="fas fa-cog"></i> Settings
            </a>

            <a href="{{$settings->whatsapp}}" target="_blank"
               class="list-group-item list-group-item-action  menu-item" data-section="settings">
                <i class="fas fa-question"></i> Support
            </a>

            <a href="javascript:Void(0)"
               onclick="document.getElementById('logout_id').submit()"
               class="list-group-item list-group-item-action  menu-item" data-section="settings">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>


            <form id="logout_id" action="{{route('logout')}}" method="post">
                @csrf
            </form>
        </div>
    </aside>


