@extends('layouts.master')

@push('page-styles')
    <!-- Calendar CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/fullcalendar.min.css')}}">
@endpush

@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    <x-page-header title="{{$title}}">
        <div class="col-auto float-right ml-auto">
            <a href="javascript:void(0)" onclick="Livewire.emit('openModal')" class="btn add-btn"><i class="fa fa-plus"></i> Add Event</a>
        </div>
    </x-page-header>
    <!-- /Page Header -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">

                            <!-- Calendar -->
                            <div id="calendar"></div>
                            <!-- /Calendar -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
@endsection


@push('modals')
<livewire:apps::apps.calendar />
@endpush
