@extends('frontend.layouts.app')
@section('title','Transaction')
@section('content')
   <div class="transaction">
        @foreach($transactions as $transaction)
            <a href="{{ route('transaction-detail',$transaction->trx_no) }}">
                <div class="card mb-2">
                    <div class="card-body p-2">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-1">TRX ID : {{ $transaction->trx_no }}</h6>
                            @if($transaction->type == 1)
                            <p class="mb-1 text-success">+{{ $transaction->amount }} <small>MMK</small></p>
                            @elseif($transaction->type == 2)
                            <p class="mb-1 text-danger">-{{ $transaction->amount }} <small>MMK</small></p>
                            @endif
                        </div>
                        <p class="mb-1 text-muted">
                            @if($transaction->type == 1)
                            <span class="text-success">From</span>
                            @elseif($transaction->type == 2)
                            <span class="text-danger">To</span>
                            @endif 
                            -{{ $transaction->Source ? $transaction->Source->name : '' }}
                        </p>
                        <p class="mb-1 text-muted">{{ $transaction->created_at }}</p>
                    </div>
                </div>
            </a>
        @endforeach
        {{$transactions->links()}}
   </div>         
@endsection
