@if($errors->has('fail'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{$errors->first('fail')}}</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>  
 @endif
 <!-- @if(session()->has('success'))
 <div class="text-green  text-2xl text-center w-full mt-2"style="">
  <h1 > {{ session('success')}} </h2>
 </div>
 @endif
 @if(session()->has('err'))
 <div class="text-red text-2xl text-center w-full mt-2"style="">
  <h1 > {{ session('err')}} </h2>
 </div>
 @endif -->
 
