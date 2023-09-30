@extends('frontend.layouts.app')
@section('title','Transfer')
@section('content')
   <div class="transfer w-100">
        <div class="card my-3">
            <div class="card-body">
                <form action="{{ route('transfer.confirm') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                            <label for="">From</label>
                            <p class="mb-1 text-muted">{{ $user->name }}</p>
                            <p class="mb-1 text-muted">{{ $user->phone }}</p>
                    </div>
                    <div class="form-group mb-2">
                        <label for="">To</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                        @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Amount (MMK)</label>
                        <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') }}">
                        @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Description</label>
                        <textarea  name="description" class="form-control">{{ old('description') }}</textarea>
                    </div>
                    <button class="btn btn-theme btn-block mt-5 form-control">Continue</button>
               </form>
            </div>
        </div>
   </div>         
@endsection
