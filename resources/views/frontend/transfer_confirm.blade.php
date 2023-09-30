@extends('frontend.layouts.app')
@section('title','Transfer Confirmation')
@section('content')
   <div class="transfer w-100">
        <div class="card my-3">
            <div class="card-body">
                <form action="{{ route('transfer.confirm') }}" method="">
                    <div class="form-group mb-3">
                            <label for="">From</label>
                            <p class="mb-1 text-muted">{{ $user->name }}</p>
                            <p class="mb-1 text-muted">{{ $user->phone }}</p>
                    </div>
                    <div class="form-group mb-2">
                        <label for="">To</label>
                        <p class=" text-muted">{{ $attributes['phone'] }}</p>
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Amount (MMK)</label>
                        <p class=" text-muted">{{ number_format($attributes['amount']) }}</p>
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Description</label>
                        <p class=" text-muted">{{ $attributes['description'] }}</p>
                    </div>
                    <button class="btn btn-theme btn-block mt-5 form-control">Confirm</button>
               </form>
            </div>
        </div>
   </div>         
@endsection
