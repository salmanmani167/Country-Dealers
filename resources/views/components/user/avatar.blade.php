@php
    $avatar = !empty($user->avatar) ? asset("storage/users/".$user->avatar): asset("assets/img/profiles/avatar.jpg");
@endphp
<h2 class="table-avatar">
<a @isset($route)target="_blank"@endisset href="{{$route ?? 'javascript:void(0)'}}" class="avatar">
    <img alt="avatar" src="{{$avatar}}">
</a>
<a @isset($route)target="_blank"@endisset href="{{$route ?? 'javascript:void(0)'}}">{{($user->firstname.' '.$user->lastname)}}</a>
</h2>
