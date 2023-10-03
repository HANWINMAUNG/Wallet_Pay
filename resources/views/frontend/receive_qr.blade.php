@extends('frontend.layouts.app')
@section('title','Receive QR')
@section('content')
   <div class="reveive-qr">
        <div class="card">
            <div class="card-body">
                <p class="text-center mb-0">QR scan pay for me</p>
                <div class="text-center">
                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(240)->generate($userAuth->phone)) !!} ">
                </div>
                <p class="text-center mb-1"><strong>{{$userAuth->name}}</strong></p>
                <p class="text-center mb-1">{{$userAuth->phone}}</p>
            </div>
        </div>
   </div>         
@endsection
