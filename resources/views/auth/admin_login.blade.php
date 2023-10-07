@extends('frontend.layouts.app_plain')
@section('title' ,'Admin Login')
@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="height:100vh;">
        <div class="col-md-6">
            <div class="card p-4 auth-form">
                <h3 class="text-center">Admin Login</h3>
                <p class="text-center" style="color:#5842E3;">Please fill to login form</p>
                <div class="card-body">
                    <form method="POST" action="{{ route('post.admin.login') }}">
                        @csrf

                        <div class="from-group mb-3">
                            <label for="email" class="">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="from-group mb-4">
                            <label for="">Password</label>
                            <input type="password" name="password" id="" class="form-control @error('password') is-invalid @enderror"  value="{{ old('password') }}">
                            @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror 
                        </div>
                        <button class="btn btn-theme btn-block my-3 form-control">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
