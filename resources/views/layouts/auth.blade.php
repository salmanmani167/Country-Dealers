<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ucwords((new \App\Settings\ThemeSettings())->site_name ?? config('app.name')).' - '.!empty($title) ? ucwords($title): 'Home'}}</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ !empty((new \App\Settings\ThemeSettings())->favicon) ? asset('storage/settings/theme/'.(new \App\Settings\ThemeSettings())->favicon):asset('assets/img/favicon.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('partials.styles')
</head>
<body class="account-page">
   <!-- Main Wrapper -->
    <div class="main-wrapper">
        <div class="account-content">
            @if (Route::has('job-list'))
            <a href="{{route('job-list')}}" class="btn btn-primary apply-btn">Apply Job</a>
            @endif
            <div class="container">

                <!-- Account Logo -->
                <div class="account-logo">
                    <a href="">
                        <img src="{{ !empty((new \App\Settings\ThemeSettings())->logo) ? asset('storage/settings/theme/'.(new \App\Settings\ThemeSettings())->logo):asset('assets/img/logo.png') }}" alt="Logo">
                    </a>
                </div>
                <!-- /Account Logo -->

                @yield('content')
            </div>
        </div>
    </div>
    <!-- /Main Wrapper -->
</body>
@include('partials.scripts')
</html>
