@extends('frontend.layouts.app')
@section('title','Transfer')
@section('content')
   <div class="transfer w-100">
        <div class="card my-3">
            <div class="card-body">
                <form action="{{ route('transfer.confirm') }}" method="GET">
                    <div class="form-group mb-3">
                            <label for="">From</label>
                            <p class="mb-1 text-muted">{{ $user->name }}</p>
                            <p class="mb-1 text-muted">{{ $user->phone }}</p>
                    </div>
                    <div class="form-group mb-2">
                        <label for="">To <span class="text-success to_account_info"></span></label>
                        <div class="input-group">
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror phone" value="{{ old('phone') }}">
                        <span class="input-group-text btn verify-btn bg-secondary" id="basic-addon2"><svg fill="#000000" width="24px" height="24px" viewBox="0 0 24 24" id="check-mark-circle-2" data-name="Flat Line" xmlns="http://www.w3.org/2000/svg" class="icon flat-line"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><polyline id="primary" points="21 5 12 14 8 10" style="fill: none; stroke: #000000; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></polyline><path id="primary-2" data-name="primary" d="M20.94,11A8.26,8.26,0,0,1,21,12a9,9,0,1,1-9-9,8.83,8.83,0,0,1,4,1" style="fill: none; stroke: #000000; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></path></g></svg></span>
                        </div>
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
@push('script')
 <script>
    $(document).ready(function(){
        $('.verify-btn').on('click' , function(){
              var phone = $('.phone').val();
              $.ajax({
                          url : 'to-account-verify?phone=' + phone,
						  type : 'GET',
						  success : function(res){
                            // console.log(res)
                             if(res.status == 'success'){
                                $('.to_account_info').text('('+res.data['name']+')');
                             }
                             else{
                                $('.to_account_info').text('('+res.message+')');
                             }
						  }
					});
        });
    });
 </script>
@endpush