@extends('layouts.master')

@section('content')
    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <x-page-header title="{{$title}}">
            <div class="col-auto float-right ml-auto">
                <a href="javascript:void(0)" onclick="Livewire.emit('openModal')" class="btn add-btn"><i class="fa fa-plus"></i> Add Client</a>
                <div class="view-icons">
                    <a href="{{route('clients.index')}}" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                    <a href="{{route('clients.list')}}" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
                </div>
            </div>
        </x-page-header>
        <!-- /Page Header -->

        <div class="row staff-grid-row">
            @foreach ($clients as $client)
            <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
                <div class="profile-widget">
                    <div class="profile-img">
                        <a href="{{route('clients.profile', $client->id)}}" class="avatar"><img alt="avatar" src="{{!empty($client->avatar) ? asset('storage/users/'.$client->avatar): asset('assets/img/profiles/avatar.jpg')}}"></a>
                    </div>
                    <div class="dropdown profile-action">
                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a onclick="Livewire.emit(`openModal`, {{json_encode(['model' => $client->id,'refresh' => true])}})" class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                            <a onclick="Livewire.emit(`openModal`,{{json_encode(['model' => $client->id,'refresh' => true, 'delete' => true])}})" class="dropdown-item trash_" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                        </div>
                    </div>
                    <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="#">{{$client->firstname.' '.$client->lastname}}</a></h4>
                    <div class="small text-muted">{{ $client->employee->designation->name ?? '' }}</div>
                    <a href="{{route('clients.profile', $client->id)}}" class="btn btn-white btn-sm m-t-10">View Profile</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- /Page Content -->
@endsection
@push('modals')
    @livewire('client')
@endpush
