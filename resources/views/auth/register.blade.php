@extends('frontend.layouts.app_plain')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="height:100vh;">
        <div class="col-md-8">
            <div class="card p-4">
                <h3 class="text-center">Register</h3>
                <p class="text-center text-info">Please fill to register form</p>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="from-group mb-3">
                            <label for="">Name</label>
                            <input type="name" name="name" id="" class="form-control @error('name') is-invalid @enderror"  value="{{ old('name') }}">
                            @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror 
                        </div>
                        <div class="from-group mb-3">
                            <label for="">Email</label>
                            <input type="email" name="email" id="" class="form-control @error('email') is-invalid @enderror"  value="{{ old('email') }}">
                            @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror 
                        </div>
                        <div class="from-group mb-3">
                            <label for="">Phone</label>
                            <input type="number" name="phone" id="" class="form-control @error('phone') is-invalid @enderror"  value="{{ old('phone') }}">
                            @error('phone')
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
                        <div class="from-group mb-4">
                            <label for="">Password Confirmation</label>
                            <input type="password" name="password_confirmation" id="" class="form-control @error('password_confirmation') is-invalid @enderror"  value="{{ old('password_confirmation') }}">
                            @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror 
                        </div>
                        <button class="btn btn-primary btn-block my-3 form-control">Register</button>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('login') }}">Already have an account?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
