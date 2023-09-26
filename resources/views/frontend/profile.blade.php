@extends('frontend.layouts.app')
@section('title','Profile')
@section('content')
     <div class="account">
        <div class="profile">
            <img src="https://ui-avatars.com/api/?background=random" alt="">
        </div>
        <div class="card my-3">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <span>Name</span>
                    <span>{{ auth()->guard('web')->user()->name }}</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <span>Phone</span>
                    <span>{{ auth()->guard('web')->user()->phone }}</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <span>Email</span>
                    <span>{{ auth()->guard('web')->user()->email }}</span>
                </div>
            </div>
        </div>
        <div class="card my-3">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <span>UpdatePassword</span>
                    <span><svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M10 7L15 12L10 17" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></span>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <span>Logout</span>
                    <span><svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M10 7L15 12L10 17" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></span>
                </div>
            </div>
        </div>
     </div>   
@endsection
