@extends('frontend.layouts.app')
@section('title','Update Password')
@section('content')
     <div class="update-password">
        <div class="card my-3">
            <div class="card-body">
                <div class="text-center">
                    <img src="{{ asset('frontend/images/update_password.png') }}" alt="">
                </div>
                <form action="{{ route('update-password.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Old Password</label>
                        <input type="password" name="old_password" class="form-control pr-2 @error('old_password') is-invalid @enderror" value="{{ old('old_password') }}">
                        @error('old_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror 
                    </div>
                    <div class="form-group mt-3">
                        <label for="">New Password</label>
                        <input type="password" name="new_password" class="form-control pr-2 @error('new_password') is-invalid @enderror" value="{{ old('new_password') }}">
                        @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror 
                    </div>
                    <button class="btn btn-theme btn-block mt-5 form-control">Update Password</button>
                </form>
            </div>
        </div>
     </div>   
@endsection
@push('script')
<script>
    $(document).ready(function(){
       
    });
</script>
@endpush