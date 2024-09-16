@extends('layouts.master')

@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    <x-page-header title="{{$title}}">
    </x-page-header>
    <!-- /Page Header -->

    <div class="row mt-5">
        <div class="col-md-8 offset-md-2">
            @livewire('settings.attendance')
        </div>
    </div>
</div>
@endsection
