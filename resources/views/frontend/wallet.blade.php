@extends('frontend.layouts.app')
@section('title','Wallet')
@section('content')
   <div class="wallet">
        <div class="card wallet-card">
            <div class="card-body">
               <div class="mb-3">
                 @php
                    $language = session('language');
                 @endphp
                 @if($language == '' || $language === 'en')
                 <span>Balance</span>
                 @else
                 <span>ငွေပမာဏ</span>
                 @endif
                 <h4>{{ number_format($user->Wallet ? $user->Wallet->amount : 0 ) }} <span>MMK</span></h4>
               </div>
               <div class="mb-4">
                  @if($language == '' || $language === 'en')
                  <span>Account Number</span>
                  @else
                  <span>အကောင့် နံပါတ်</span>
                  @endif
                  <h5>{{ $user->Wallet ? $user->Wallet->account_number : '-'  }}</h5>
               </div>
               <div>
                  <p>{{ $user->name }}</p>
               </div>
            </div>
        </div>
   </div>         
@endsection
