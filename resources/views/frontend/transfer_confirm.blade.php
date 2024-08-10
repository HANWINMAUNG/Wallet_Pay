@extends('frontend.layouts.app')
@section('title','Transfer Confirmation')
@section('content')
   <div class="transfer w-100">
                   @php
                        $language = session('language');
                    @endphp
        <div class="card my-3">
            <div class="card-body">
                @include('frontend.layouts.page_info')
                <form action="{{ route('transfer.complete') }}" method="POST" id="form">
                    @csrf
                    <input type="hidden" name="hash_value" value="{{ $hash_value }}">
                    <input type="hidden" name="phone" value="{{ $attributes['phone'] }}">
                    <input type="hidden" name="amount" value="{{ $attributes['amount'] }}">
                    <input type="hidden" name="description" value="{{ $attributes['description'] }}">
                    <div class="form-group mb-3">
                            @if($language == '' || $language === 'en')
                            <label for="">From</label>
                            @else
                            <label for="">မှ</label>
                            @endif
                            <p class="mb-1 text-muted">{{ $userAuth->name }}</p>
                            <p class="mb-1 text-muted">{{ $userAuth->phone }}</p>
                    </div> 
                    <div class="form-group mb-2">
                            @if($language == '' || $language === 'en')
                            <label for="">To</label>
                            @else
                            <label for="">သို့</label>
                            @endif
                        <p class="mb-0 text-muted">{{ $to_user->name }}</p>
                        <p class=" text-muted">{{ $attributes['phone'] }}</p>
                    </div>
                    <div class="form-group mb-2">
                        @if($language == '' || $language === 'en')
                        <label for="">Amount (MMK)</label>
                        @else
                            <label for="">ငွေပမာဏ(ကျပ်)</label>
                        @endif
                        <p class=" text-muted">{{ number_format($attributes['amount']) }}</p>
                    </div>
                    <div class="form-group mb-2">
                        @if($language == '' || $language === 'en')
                        <label for="">Note</label>
                        @else
                            <label for="">မှတ်ချက်</label>
                        @endif
                        <p class=" text-muted">{{ $attributes['description'] }}</p>
                    </div>
                    <button type="submit" class="btn btn-theme btn-block mt-5 form-control complete-btn">Confirm</button>
               </form>
            </div>
        </div>
   </div>         
@endsection
@push('script')
 <script>
    $(document).ready(function(){
        $('.complete-btn').on('click' , function(e){
            e.preventDefault();
            Swal.fire({
                title: 'Please fill your password!',
                icon: 'info',
                html:'<input type="password" class="form-control text-center password autofocus" >',
                showCancelButton: true,
                confirmButtonText: 'Confirm',
                cancelButtonText: 'Cancel',
                reverseButtons: true
             }).then((result) => {
                    if (result.isConfirmed) {
                        var password = $('.password').val();
                        $.ajax({
                          url : '/password-check?password=' + password,
						  type : 'GET',
						  success : function(res){
                             if(res.status == 'success'){
                                $('#form').submit();
                             }
                             else{
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: res.message,
                                    });
                             }
						  }
					}); 
                    }
                    });        
        });
    });
 </script>
@endpush