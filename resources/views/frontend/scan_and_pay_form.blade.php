@extends('frontend.layouts.app')
@section('title','Scan & Pay Form')
@section('content')
   <div class="transfer w-100">
        <div class="card my-3">
            <div class="card-body">
            @include('frontend.layouts.page_info')
                <form action="{{ route('scan-and-pay-confirm') }}" method="GET" id="transfer-form">
                    <input type="hidden" class="hash-value"  name="hash_value" value="">
                    <input type="hidden" name="phone" class="phone" value="{{ $to_account->phone }}">
                    <div class="form-group mb-3">
                    @php
                        $language = session('language');
                    @endphp
                            @if($language == '' || $language === 'en')
                            <label for="">From</label>
                            @else
                            <label for="">မှ</label>
                            @endif
                            <p class="mb-1 text-muted">{{ $form_account->name }}</p>
                            <p class="mb-1 text-muted">{{ $form_account->phone }}</p>
                    </div>

                    <div class="form-group mb-3">
                            @if($language == '' || $language === 'en')
                            <label for="">To</label>
                            @else
                            <label for="">သို့</label>
                            @endif
                            <p class="mb-1 text-muted">{{ $to_account->name }}</p>
                            <p class="mb-1 text-muted">{{ $to_account->phone }}</p>
                    </div>
                    
                    <div class="form-group mb-2">
                        @if($language == '' || $language === 'en')
                        <label for="">Amount (MMK)</label>
                        @else
                            <label for="">ငွေပမာဏ(ကျပ်)</label>
                        @endif
                        <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror amount" value="{{ old('amount') }}">
                        @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        @if($language == '' || $language === 'en')
                        <label for="">Note</label>
                        @else
                            <label for="">မှတ်ချက်</label>
                        @endif
                        <textarea  name="description" class="form-control description">{{ old('description') }}</textarea>
                    </div>
                    <button class="btn btn-theme btn-block mt-5 form-control submit-btn">Continue</button>
               </form>
            </div>
        </div>
   </div>         
@endsection
@push('script')
 <script>
    $(document).ready(function(){
        $('.submit-btn').on('click', function(e){
            e.preventDefault();
                var phone = $('.phone').val();
                var amount = $('.amount').val();
                var description = $('.description').val();
                $.ajax({
                          url : `/transfer-hash?phone=${phone}&amount=${amount}&description=${description}`,
						  type : 'GET',
						  success : function(res){
                             if(res.status == 'success'){
                                $('.hash-value').val(res.data);
                                $('#transfer-form').submit();
                             }
						  }
				});
        });
    });
 </script>
@endpush