@extends('frontend.layouts.app')
@section('title','Notification Detail')
@section('content')
   <div class="notification-detail" style="margin-top:40px;">
                <div class="card">
                    <div class="card-body text-center">
                       <div class="mb-3">
                            <img src="{{ asset('frontend/images/notification.png') }}" alt="">
                       </div> 
                       <h6>{{ $notification->data['title'] }}</h6>
                       <p class=" text-mutedmb-1">{{ $notification->data['message'] }}</p>
                       <p class=" mb-3"><small>{{ Carbon\Carbon::parse($notification->created_at)->format('Y-m-d h:i:s A')}}</small></p>
                       <a href="{{ $notification->data['web_link'] }}" class="btn btn-theme">Continue</a>           
                </div>
   </div>         
@endsection
