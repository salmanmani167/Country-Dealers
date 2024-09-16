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
<body>
<!-- Main Wrapper -->
<div class="main-wrapper">

    @include('partials.header')

    @include('partials.sidebar')

    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <!-- Page Content -->
        @yield('content')
        <!-- /Page Content -->
        @stack('modals')

    </div>
    <!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->
</body>
@include('partials.scripts')
</html>
