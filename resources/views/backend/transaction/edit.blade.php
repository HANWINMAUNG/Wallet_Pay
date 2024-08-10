@extends('backend.layouts.app')
@section('user','active')
@section('content')
<main class="content">
				<div class="container-fluid p-0">
					<h1 class="h3 mb-3"><strong>User Edit</strong></h1>
					<div class="py-3 d-flex flex-row-reverse">
						<button class="btn btn-secondary back-btn">Back <i class="align-middle" data-feather="arrow-left"></i></button>
					</div>
                    <div class="">
						<div class="card">
							<div class="card-body">
									<div class = "p-2">
                                        @include('backend.layouts.flash')
										<form action="{{ route('user.update' , $user->id) }}" method="post" id="update">
                                            @csrf
                                            @method('PATCH')
                                            <div class="from-group">
                                                <label for="">Name</label>
                                                <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                                            </div>
                                            <div class="from-group mt-2">
                                                <label for="">Email</label>
                                                <input type="email" name="email"  value="{{ $user->email }}" class="form-control">
                                            </div>
                                            <div class="from-group mt-2">
                                                <label for="">Phone</label>
                                                <input type="number" name="phone" value="{{ $user->phone }}" class="form-control">
                                            </div>
                                            <div class="from-group mt-2">
                                                <label for="">Password</label>
                                                <input type="password" name="password" class="form-control">
                                            </div>
                                            <div class="d-flex justify-content-center pt-2">
                                                <button class="btn btn-secondary back-btn" style="margin-right:10px;">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
									</div>
							</div>
						</div>
					</div>				
				</div>
</main> 
@endsection
@push('script')
{!! JsValidator::formRequest('App\Http\Requests\UpdateUserRequest' , '#update') !!}
<script type="text/javascript">
</script>
@endpush