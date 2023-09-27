@extends('frontend.layouts.app')
@section('title','UpdatePassword')
@section('content')
     <div class="update-password">
        <div class="card my-3">
            <div class="card-body">
                <div class="text-center">
                    <img src="{{ asset('frontend/images/update_password.png') }}" alt="">
                </div>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="">Old Password</label>
                        <input type="password" name="old_password" class="form-control pr-2">
                    </div>
                    <div class="form-group mt-3">
                        <label for="">New Password</label>
                        <input type="password" name="new_password" class="form-control pr-2">
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