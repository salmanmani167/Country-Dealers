<!-- Header -->
<div class="header">

    <!-- Logo -->
    <div class="header-left">
        <a href="{{route('dashboard')}}" class="logo">
            <img src="{{ !empty((new \App\Settings\ThemeSettings())->logo) ? asset('storage/settings/theme/'.(new \App\Settings\ThemeSettings())->logo):asset('assets/img/logo.png') }}" width="40" height="40" alt="logo">
        </a>
    </div>
    <!-- /Logo -->

    <a id="toggle_btn" href="javascript:void(0);">
        <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </a>

    <!-- Header Title -->
    <div class="page-title-box">
        <h3>{{ucwords((new \App\Settings\ThemeSettings())->site_name ?? config('app.name'))}}</h3>
    </div>
    <!-- /Header Title -->

    <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>

    <!-- Header Menu -->
    <ul class="nav user-menu">


        @if(!empty(\Session::get('impersonated_by')))
        <li class="nav-item">
            <a class="btn" href="{{ route('impersonate.leave') }}">Exit Impersonation</a>
        </li>
        @endif
        <!-- Notifications -->
        <li class="nav-item dropdown">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i> <span class="badge badge-pill">{{auth()->user()->unreadNotifications->count()}}</span>
            </a>
            <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header">
                    <span class="notification-title">Notifications</span>
                    <a href="{{route('notifications.markAllAsRead')}}" class="clear-noti"> Clear All </a>
                </div>
                <div class="noti-content">
                    <ul class="notification-list">
                        @foreach (auth()->user()->unreadNotifications as $notification)
                        <li class="notification-message">
                            <a href="{{route('notifications.index')}}">
                                <div class="media">
                                    <div class="media-body">
                                        <p class="noti-details"><span class="noti-title">{{$notification->data['subject']}}</span> </p>
                                        <p class="noti-time"><span class="notification-time">{{$notification->created_at->diffForHumans()}}</span></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="{{route('notifications.index')}}">View all Notifications</a>
                </div>
            </div>
        </li>
        <!-- /Notifications -->



        <li class="nav-item dropdown has-arrow main-drop">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                <span class="user-img">
                    <img src="{{!empty(auth()->user()->avatar) ? asset('storage/users/'.auth()->user()->avatar): asset('assets/img/profiles/avatar.jpg')}}" alt="avatar">
                <span class="status online"></span></span>
                <span>{{auth()->user()->username}}</span>
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{route('profile')}}">My Profile</a>
                <a class="dropdown-item" href="{{route('update-password')}}">Change Password</a>
                <form action="{{route('logout')}}" method="post">
                    @csrf
                    <button type="submit" class="dropdown-item">Logout</button>
                </form>
            </div>
        </li>
    </ul>
    <!-- /Header Menu -->

    <!-- Mobile Menu -->
    <div class="dropdown mobile-user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{route('profile')}}">My Profile</a>
            <a class="dropdown-item" href="{{route('update-password')}}">Change Password</a>
            <form action="{{route('logout')}}" method="post">
                @csrf
                <button type="submit" class="dropdown-item">Logout</button>
            </form>
        </div>
    </div>
    <!-- /Mobile Menu -->

</div>
<!-- /Header -->
