@extends('backend.layouts.app')
@push('header')
<link href="{{ asset('backend/css/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/select2.bootstrap.min.css') }}" rel="stylesheet">
@endpush
@section('wallet','active')
@section('content')
<main class="content">
				<div class="container-fluid p-0">
					<h1 class="h3 mb-3"><strong>Wallet Amount Reduce</strong></h1>
					<div class="py-3 d-flex flex-row-reverse">
						<button class="btn btn-secondary back-btn">Back <i class="align-middle" data-feather="arrow-left"></i></a>
					</div>
                    <div class="">
						<div class="card">
							<div class="card-body">
									<div class = "p-2">
                                        @include('backend.layouts.flash')
										<form action="{{ route('remove.amount.requce') }}" method="post" id="create">
                                            @csrf
                                            <div class="from-group">
                                                <label for="">Users</label>
                                                <select name="user_id" id="" class="form-control select2">
                                                    <option value="">--Please choose--</option>
                                                    @foreach($users as $user)
                                                    <option value="{{$user->id}}">{{$user->name}} ({{$user->phone}})</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="from-group mt-2">
                                                <label for="">Amount</label>
                                                <input type="number" name="amount" class="form-control">
                                            </div>
                                            <div class="from-group mt-2">
                                                <label for="">Description</label>
                                                <textarea name="description" id=""class="form-control"></textarea>
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
{!! JsValidator::formRequest('App\Http\Requests\WalletRemoveRequest' , '#create') !!}
<script src="{{ asset('backend/js/select2.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
    $('.select2').select2({
        theme: 'bootstrap4',
        placeholder: "--Please choose--",
        allowClear: true
    });
});
</script>
@endpush