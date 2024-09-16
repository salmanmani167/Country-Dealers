@extends('layouts.master')

@push('page-styles')
<link href="{{ asset('vendor/laravel_backup_panel/bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/laravel_backup_panel/app.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('assets/plugins/toastify/src/toastify.css')}}">

@endpush

@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    <x-page-header title="{{$title}}">
    </x-page-header>
    <!-- /Page Header -->

    <livewire:laravel_backup_panel::app />

</div>
@endsection


@push('page-scripts')
<script src="{{asset('assets/plugins/toastify/src/toastify.js')}}"></script>
@endpush
