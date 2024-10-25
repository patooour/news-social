<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.home')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{config('app.name')}} <sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    @can('home')
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('admin.home')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    @endcan

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>




{{--
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>--}}

    {{--<!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
           aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="login.html">Login</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li>--}}
    @can('admins')
        <!-- Nav Item - Admins Management Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#AdminsPages"
               aria-expanded="true" aria-controls="UserPages">
                <i class="fas fa-fw fa-calendar"></i>
                <span>Admins</span>
            </a>
            <div id="AdminsPages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Admins management: </h6>

                    <a class="collapse-item" href="{{route('admin.admins.index')}}">Admins</a>
                    <a class="collapse-item" href="{{route('admin.admins.create')}}">Add New Admin</a>


                </div>
            </div>
        </li>
    @endcan
    @can('authorizations')
        <!-- Nav Item - Authorization Management Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#AuthorizationPages"
               aria-expanded="true" aria-controls="AuthorizationPages">
                <i class="fas fa-fw fa-calendar"></i>
                <span>Authorization</span>
            </a>
            <div id="AuthorizationPages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Roles management: </h6>

                    <a class="collapse-item" href="{{route('admin.authorizations.index')}}">Roles</a>
                    <a class="collapse-item" href="{{route('admin.authorizations.create')}}">Add New Role</a>


                </div>
            </div>
        </li>
    @endcan
    @can('users')
    <!-- Nav Item - Users Management Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#UserPages"
           aria-expanded="true" aria-controls="UserPages">
            <i class="fas fa-fw fa-users"></i>
            <span>Users</span>
        </a>
        <div id="UserPages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Users management: </h6>

                <a class="collapse-item" href="{{route('admin.users.index')}}">Users</a>
                <a class="collapse-item" href="{{route('admin.users.create')}}">Add Users</a>
                <a class="collapse-item" href="404.html">404 Page</a>

            </div>
        </div>
    </li>
    @endcan
    @can('categories')
    <!-- Nav Item - Categories Management Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#CategoriesPages"
           aria-expanded="true" aria-controls="UserPages">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Categories</span>
        </a>
        <div id="CategoriesPages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Categories management: </h6>
                <a class="collapse-item" href="{{route('admin.categories.index')}}">Categories</a>
                <a class="collapse-item" href="404.html">404 Page</a>

            </div>
        </div>
    </li>
    @endcan
    @can('posts')
        <!-- Nav Item - Posts Management Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#postsPages"
               aria-expanded="true" aria-controls="UserPages">
                <i class="fas fa-fw fa-calendar"></i>
                <span>Posts</span>
            </a>
            <div id="postsPages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Posts management: </h6>

                    <a class="collapse-item" href="{{route('admin.posts.index')}}">Posts</a>
                    <a class="collapse-item" href="{{route('admin.posts.create')}}">Add Post</a>
                    <a class="collapse-item" href="404.html">404 Page</a>

                </div>
            </div>
        </li>
    @endcan
    @can('settings')
    <!-- Nav Item - Settings Management Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#SettingsPages"
           aria-expanded="true" aria-controls="UserPages">
            <i class="fas fa-fw fa-stethoscope"></i>
            <span>Settings</span>
        </a>
        <div id="SettingsPages" class="collapse" aria-labelledby="headingPages" data-parent="#SettingsPages">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Settings management: </h6>
                <a class="collapse-item" href="{{route('admin.settings.index')}}">Settings</a>


            </div>
        </div>
    </li>
    @endcan
    @can('contacts')
        <!-- Nav Item - Posts Management Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#contactsPages"
               aria-expanded="true" aria-controls="contactsPages">
                <i class="fas fa-fw fa-calendar"></i>
                <span>Contacts</span>
            </a>
            <div id="contactsPages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Contacts management: </h6>

                    <a class="collapse-item" href="{{route('admin.contacts.index')}}">Contacts</a>

                </div>
            </div>
        </li>
    @endcan
    @can('notifications')
        <!-- Nav Item - Posts Management Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#notificationsPages"
               aria-expanded="true" aria-controls="notificationsPages">
                <i class="fas fa-fw fa-calendar"></i>
                <span>notifications</span>
            </a>
            <div id="notificationsPages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Notifications management: </h6>

                    <a class="collapse-item" href="{{route('admin.notifications.index')}}">Notifications</a>

                </div>
            </div>
        </li>
    @endcan

   {{-- <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li>
--}}
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->


</ul>
<!-- End of Sidebar -->
