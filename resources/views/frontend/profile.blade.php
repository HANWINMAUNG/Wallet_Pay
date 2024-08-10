@extends('frontend.layouts.app')
@section('title','Profile')
@section('content')
     <div class="account" style="margin-top:40px;">
        <div class="profile">
            <img src="https://ui-avatars.com/api/?background=random&name={{ auth()->guard('web')->user()->name }}" alt="">
        </div>
        @php
            $language = session('language');
        @endphp
        <div class="card my-3">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    @if($language == '' || $language === 'en')
                    <span>Name</span>
                    @else
                    <span>နာမည်</span>
                    @endif
                    <span>{{ auth()->guard('web')->user()->name }}</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    @if($language == '' || $language === 'en')
                    <span>Phone</span>
                    @else
                    <span>ဖုန်းနံပါတ်</span>
                    @endif
                    <span>{{ auth()->guard('web')->user()->phone }}</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    @if($language == '' || $language === 'en')
                    <span>Email</span>
                    @else
                    <span>အီးမေး</span>
                    @endif
                    <span>{{ auth()->guard('web')->user()->email }}</span>
                </div>
            </div>
        </div>
        <div class="card my-3">
            <div class="card-body">
                <a href="{{ route('update-password') }}" class="d-flex justify-content-between update-password">
                    @if($language == '' || $language === 'en')
                    <span>UpdatePassword</span>
                    @else
                    <span>လျှို့ဝှက်နံပါတ်ပြောင်းရန်</span>
                    @endif
                    <span><svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M10 7L15 12L10 17" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></span>
                </a>
                <hr>
                <a href="#" class="d-flex justify-content-between logout">
                    @if($language == '' || $language === 'en')
                    <span>Logout</span>
                    @else
                    <span>အကောင့်ထွက်ရန်</span>
                    @endif
                    <span><svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M10 7L15 12L10 17" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></span>
                </a>
            </div>
        </div>
     </div>   
@endsection
@push('script')
<script>
    $(document).ready(function(){
        $(document).on('click','.logout',function(e){
			e.preventDefault();
			Swal.fire({
				title: 'Are you sure,you want to logout?',
				showCancelButton: true,
				confirmButtonText: 'Confirm',
                reverseButtons: true,
				}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
                          url : "{{ route('user.logout') }}",
						  type : 'POST',
						  success : function(){
                                window.location.replace("{{ route('profile') }}");
						  }
					});
				}
				})
		});
    });
</script>
@endpush