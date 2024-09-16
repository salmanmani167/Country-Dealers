@extends('layouts.master')

@section('content')
<div class="row mt-5">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{route('update-password.post', auth()->user()->id)}}">
                    @csrf
                    <div class="form-group">
                        <x-form.input type="password" name="current_password" label="Current Password"></x-form.input>
                    </div>
                    <div class="form-group">
                        <x-form.input type="password" name="password" label="New Password"></x-form.input>
                    </div>
                    <div class="form-group">
                        <x-form.input type="password" name="password_confirmation" label="Confirm Password"></x-form.input>
                    </div>

                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
