@extends('layouts.master')


@section('content')
<!-- Page Content -->
<div class="content container-fluid">

    <!-- Page Header -->
    <x-page-header :title="$title"></x-page-header>
    <!-- /Page Header -->

    <div class="card mb-0">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-view py-3">
                        <div class="profile-img-wrap">
                            <div class="profile-img">
                                <a href="#"><img alt="avatar" src="{{!empty(auth()->user()->avatar) ? asset('storage/users/'.auth()->user()->avatar): asset('assets/img/profiles/avatar.jpg')}}"></a>
                            </div>
                        </div>
                        <div class="profile-basic">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="profile-info-left">
                                        <h3 class="user-name m-t-0 mb-0">{{auth()->user()->firstname.' '.auth()->user()->lastname}}</h3>
                                        <div class="small doj text-muted">Date of Join : {{format_date(auth()->user()->created_at,'D M, Y')}}</div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">Phone:</div>
                                            <div class="text"><a href="#">{{auth()->user()->phone}}</a></div>
                                        </li>
                                        <li>
                                            <div class="title">Email:</div>
                                            <div class="text"><a href="#">{{auth()->user()->email}}</a></div>
                                        </li>
                                        <li>
                                            <div class="title">Birthday:</div>
                                            <div class="text">{{!empty(auth()->user()->birthdate) ? format_date(auth()->user()->birthdate,'d M, Y'): ''}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Address:</div>
                                            <div class="text">{{auth()->user()->address}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Gender:</div>
                                            <div class="text">{{auth()->user()->gender}}</div>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="pro-edit"><a data-target="#profile_info" data-toggle="modal" class="edit-icon" href="#"><i class="fa fa-pencil"></i></a></div>
                        {{-- profile edit --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('modals')
 <x-user.profile-modal />
@endpush
