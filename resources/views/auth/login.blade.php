@extends('frontend.layouts.app_plain')
@section('title' ,'Login')
@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="height:100vh;">
           <div class="col-md-6">
            <div class="card p-4 auth-form">
                <div class="d-flex justify-content-end">
                            <form id="form_select" action="{{ route('language.switch')}}" method="POST" >
								@csrf
								<select name="language" onchange="document.getElementById('form_select'). submit()" class="mt-2">
								     <option value="en" {{ app()->getLocale() === 'en'? 'selected':''}}>English</option>
									 <option value="my" {{ app()->getLocale() === 'my'? 'selected':''}}>Myanmar</option> 
								</select>
							</form>
                </div>
                @php
                    $language = session('language');
                @endphp
               <div class="text-center">
                 <img src="{{ asset('backend/assets/img/m_pay_logo.svg')}}" style="width:100px;heght:100px;" alt="">
               </div>
               @if($language == '' || $language === 'en')
                    <p class="text-center" style="color:#5842E3;">Please fill to login form</p>
               @else
                    <p class="text-center" style="color:#5842E3;">ကျေးဇူးပြု၍အကောင့်ဝင်ပါ</p>
               @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="from-group mb-3">
                            @if($language == '' || $language === 'en')
                            <label for="">Phone</label>
                            @else
                            <label for="">ဖုန်းနံပါတ်</label>
                            @endif
                            <input type="text" name="phone" id="" class="form-control @error('phone') is-invalid @enderror"  value="{{ old('phone') }}">
                            @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror 
                        </div>

                        <div class="from-group mb-4">
                            @if($language == '' || $language === 'en')
                            <label for="">Password</label>
                            @else
                            <label for="">လျှိုဝှက်နံပါတ်</label>
                            @endif
                            <input type="password" name="password" id="" class="form-control @error('password') is-invalid @enderror"  value="{{ old('password') }}">
                            @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror 
                        </div>
                        @if($language == '' || $language === 'en')
                        <button class="btn btn-theme btn-block my-3 form-control">Login</button>
                        @else
                        <button class="btn btn-theme btn-block my-3 form-control">ဝင်ရန်</button>
                        @endif
                        <div class="d-flex justify-content-between">
                            @if($language == '' || $language === 'en')
                            <a href="{{ route('register') }}">Register Now</a>
                            @else
                            <a href="{{ route('register') }}">အကောင့်ဖွင့်ရန်</a>
                            @endif
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
