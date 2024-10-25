@extends('fronted.common.app')

@section('title')
Setting
@endsection

@section('breadCrumb')
    @parent

@endsection

@section('content')
    <br> <br>

<!-- Dashboard Start -->
<div class="dashboard container">
    <!-- Sidebar -->
    @include('fronted.dashboard.common.sidebar' , ['setting_active' =>'active'])
    <!-- Main Content -->
    <div class="main-content">
        <!-- Settings Section -->
        <section id="settings" class="content-section active">
            <h2>Settings</h2>

            @include('fronted.common.errors')
            <form class="settings-form" enctype="multipart/form-data"
                  method="post" action="{{route('fronted.dashboard.setting.update')}}">
                @csrf

                <div class="form-group">
                    <label for="name">Name: </label>
                    <input type="text" name="name" id="email" value="{{$user->name}}" />
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="{{$user->username}}" />
                </div>
                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="email" name="email" id="email" value="{{$user->email}}" />
                </div>
                <div class="form-group">
                    <label for="profile-image">Profile Image:</label>
                    <input type="file" name="image" id="profile-image" accept="image/*" />
                </div>
                <div class="form-group">
                    <label for="country">Country: </label>
                    <input
                        name="country"
                        type="text"
                        id="country"
                        value="{{$user->country}}"
                    />
                </div>
                <div class="form-group">
                    <label for="city">City: </label>
                    <input type="text" id="city" name="city"  value="{{$user->city}}" />
                </div>
                <div class="form-group">
                    <label for="street">Street: </label>
                    <input type="text" id="street"  name="street" value="{{$user->street}}" />
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="number" id="phone"  name="phone" value="{{$user->phone}}" />
                </div>

                <button type="submit" class="save-settings-btn">
                    Save Changes
                </button>
            </form>


            <!-- Form to change the password -->
            <form class="change-password-form"
                  method="post"
                  action="{{route('fronted.dashboard.setting.password')}}">
                @csrf
                <h2>Change Password</h2>
                <div class="form-group">
                    <label for="current-password">Current Password:</label>
                    <input
                        type="password"
                        id="current-password"
                        name="current_password"
                        placeholder="Enter Current Password"
                    />
                </div>
                <div class="form-group">
                    <label for="password">New Password:</label>
                    <input
                        name="password"
                        type="password"
                        id="password"
                        placeholder="Enter New Password"
                    />
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirm New Password:</label>
                    <input
                        name="password_confirmation"
                        type="password"
                        id="confirm-password"
                        placeholder="Enter Confirm New "
                    />
                </div>
                <button type="submit" class="change-password-btn">
                    Change Password
                </button>
            </form>
        </section>

    </div>
</div>
<!-- Dashboard End -->

    <br> <br>
@endsection
