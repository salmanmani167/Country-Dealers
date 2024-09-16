@extends('layouts.auth')

@section('content')
<div class="account-box">
    <div class="account-wrapper">
        <h3 class="account-title">Register</h3>

        <!-- Account Form -->
        <form method="POST" action="{{route('register')}}">
            @csrf
            <div class="form-group">
                <label>FirstName</label>
                <input name="firstname" type="text" value="{{old('firstname')}}" class="form-control  @error('firstname') is-invalid @enderror" placeholder="FirstName">
                @error('firstname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>LastName</label>
                <input name="lastname" type="text" value="{{old('lastname')}}" class="form-control  @error('lastname') is-invalid @enderror" placeholder="LastName">
                @error('lastname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Username</label>
                <input name="username" type="text" value="{{old('username')}}" class="form-control  @error('username') is-invalid @enderror" placeholder="UserName">
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Email</label>
                <input class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" type="text" name="email" placeholder="Email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Repeat Password</label>
                <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" placeholder="Confirm Password">
                @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group text-center">
                <button class="btn btn-primary account-btn" type="submit">Register</button>
            </div>
            <div class="account-footer">
                <p>Already have an account? <a href="{{route('login')}}">Login</a></p>
            </div>
        </form>
        <!-- /Account Form -->
    </div>
</div>
@endsection
