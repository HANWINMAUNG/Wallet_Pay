@extends('frontend.layouts.app')
@section('title','Receive QR')
@section('content')
   <div class="reveive-qr">
         @php
            $language = session('language');
         @endphp
        <div class="card">
            <div class="card-body">
                @if($language == '' || $language === 'en')
                <p class="text-center mb-0">Scan pay for me</p>
                @else
                <p class="text-center mb-0">စကင်န်ဖတ်ပြီးငွေလွဲရန်</p>
                @endif
                <div class="text-center">
                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(240)->generate($userAuth->phone)) !!} ">
                </div>
                <p class="text-center mb-1"><strong>{{$userAuth->name}}</strong></p>
                <p class="text-center mb-1">{{$userAuth->phone}}</p>
            </div>
        </div>
   </div>         
@endsection
