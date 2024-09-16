@extends('layouts.auth')

@section('content')
<div class="account-box">
    <div class="account-wrapper">
        <h3 class="account-title">Login</h3>
        <p class="account-subtitle">Access to our dashboard</p>

        <!-- Account Form -->
        <form method="POST" action="{{route('login')}}">
            @csrf
            <div class="form-group">
                <label>Email Address</label>
                <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" value="{{ old('email') }}" tabindex="1">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label>Password</label>
                    </div>
                    <div class="col-auto">
                        <a class="text-muted" href="{{route('forgot-password')}}">
                            Forgot password?
                        </a>
                    </div>
                </div>
                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" tabindex="2">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group text-center">
                <button class="btn btn-primary account-btn" type="submit">Login</button>
            </div>
            <div class="account-footer">
                <p>Don't have an account yet? <a href="{{route('register')}}">Register</a></p>
            </div>
        </form>
        <!-- /Account Form -->

    </div>
</div>
@endsection
