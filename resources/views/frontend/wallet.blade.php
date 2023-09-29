@extends('frontend.layouts.app')
@section('title','Wallet')
@section('content')
   <div class="wallet">
        <div class="card wallet-card">
            <div class="card-body">
               <div class="mb-3">
                 <span>Balance</span>
                 <h4>{{ number_format($user->Wallet ? $user->Wallet->amount : 0 ) }} <span>MMK</span></h4>
               </div>
               <div class="mb-4">
                  <span>Account Number</span>
                  <h5>{{ $user->Wallet ? $user->Wallet->account_number : '-'  }}</h5>
               </div>
               <div>
                  <p>{{ $user->name }}</p>
               </div>
            </div>
        </div>
   </div>         
@endsection
