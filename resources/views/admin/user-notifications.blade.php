@extends('layouts.master')

@section('page-styles')

@endsection

@section('content')
<div class="content container-fluid">

   <!-- Page Header -->
   <x-page-header title="{{$title}}">
    </x-page-header>
    <!-- /Page Header -->


    <div class="row">
        <div class="col-md-12">
            <div class="activity">
                <div class="activity-box">
                    <ul class="activity-list">
                        @foreach ($notifications as $key => $notification)
                        @php
                            $user = \App\Models\User::find($notification->data['user']);
                        @endphp
                        <li>
                            <div class="activity-user">
                                <a href="javascript:void(0)" title="{{$user->firstname.' '.$user->lastname}}" data-toggle="tooltip" class="avatar">
                                    <img src="{{!empty($user->avatar) ? asset('storage/users/'.$user->avatar): asset('assets/img/profiles/avatar.jpg')}}" alt="avatar">
                                </a>
                            </div>
                            <div class="activity-content">
                                <div class="timeline-content">
                                    <a data-toggle="collapse" href="#nt_{{$notification->id}}_collapseDetails" role="button" aria-expanded="false" aria-controls="nt_{{$notification->id}}_collapseDetails" class="name"><b>Posted By: </b>{{$user->firstname.' '.$user->lastname}}</a>
                                    <p>{{$notification->data['subject']}}</p>
                                    <span class="time">{{$notification->created_at->diffForHumans()}}</span>

                                    <div class="collapse" id="nt_{{$notification->id}}_collapseDetails">
                                        <p>{{$notification->data['body']}}</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('modals')

@endpush


@section('page-scripts')

@endsection
