@extends('frontend.layouts.app_plain')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="height:100vh;">
        <div class="col-md-8">
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
                @if($language == '' || $language === 'en')
                <h3 class="text-center">Register</h3>
                <p class="text-center text-info">Please fill to register form</p>
                @else
                <h3 class="text-center">အကောင့်ဖွင့်ရန်</h3>
                <p class="text-center text-info">ကျေးဇူးပြု၍အကောင့်ဖွင့်ပါ</p>
                @endif

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="from-group mb-3">
                            @if($language == '' || $language === 'en')
                            <label for="">Name</label>
                            @else
                            <label for="">နာမည်</label>
                            @endif
                            <input type="name" name="name" id="" class="form-control @error('name') is-invalid @enderror"  value="{{ old('name') }}">
                            @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror 
                        </div>
                        <div class="from-group mb-3">
                            @if($language == '' || $language === 'en')
                            <label for="">Email</label>
                            @else
                            <label for="">အီးမေးလ်</label>
                            @endif
                            <input type="email" name="email" id="" class="form-control @error('email') is-invalid @enderror"  value="{{ old('email') }}">
                            @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror 
                        </div>
                        <div class="from-group mb-3">
                            @if($language == '' || $language === 'en')
                            <label for="">Phone</label>
                            @else
                            <label for="">ဖုန်းနံပါတ်</label>
                            @endif
                            <input type="number" name="phone" id="" class="form-control @error('phone') is-invalid @enderror"  value="{{ old('phone') }}">
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
                        <div class="from-group mb-4">
                            @if($language == '' || $language === 'en')
                            <label for="">Password Confirmation</label>
                            @else
                            <label for="">သေချာသောလျှိုဝှက်နံပါတ်</label>
                            @endif
                            <input type="password" name="password_confirmation" id="" class="form-control @error('password_confirmation') is-invalid @enderror"  value="{{ old('password_confirmation') }}">
                            @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror 
                        </div>
                        @if($language == '' || $language === 'en')
                        <button class="btn btn-theme btn-block my-3 form-control">Register</button>
                        @else
                        <button class="btn btn-theme btn-block my-3 form-control">အကောင့်ဖွင့်ရန်</button>
                        @endif
                        <div class="d-flex justify-content-between">
                            @if($language == '' || $language === 'en')
                            <a href="{{ route('login') }}">Already have an account?</a>
                            @else
                            <a href="{{ route('login') }}">အကောင့်ရှိလျှင်</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
