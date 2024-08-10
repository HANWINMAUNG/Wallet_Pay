@extends('backend.layouts.app')
@section('transaction','active')
@section('content')
<div class="content" >
               <div class="container-fluid p-0">
                    <h1 class="h3 mb-3"><strong>Transaction Detail</strong></h1>
					<div class="py-3 d-flex flex-row-reverse">
						<button class="btn btn-secondary back-btn">Back <i class="align-middle" data-feather="arrow-left"></i></button>
					</div>
                    <div class="card">
                        <div class="card-body">
                        <div class="text-center mb-3">
                            <svg fill="#5842E3" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px" viewBox="0 0 123.952 123.952" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <circle cx="22.211" cy="20.915" r="10.716"></circle> <path d="M29.338,34.239c-0.179-0.11-0.367-0.188-0.556-0.269c-1.194-0.796-2.534-1.382-3.901-1.718l-2.67,2.687l-2.587-2.716 c-0.009,0.002-0.021,0.002-0.028,0.005c-1.979,0.473-3.902,1.477-5.409,2.888C5.925,40.672,2.409,48.035,0.045,64.141 c-0.334,2.272,1.238,4.387,3.511,4.719c0.207,0.031,0.41,0.045,0.611,0.045c2.029,0,3.807-1.488,4.108-3.557 c0.852-5.795,1.836-10.03,2.97-13.229v13.101c0,1.119,0.217,2.162,0.598,3.123c-0.03,0.217-0.051,0.436-0.051,0.659l0.004,39.835 c0,2.715,2.201,4.917,4.916,4.917c2.717-0.001,4.916-2.202,4.916-4.918l-0.003-34.187c0.197,0.009,0.39,0.023,0.586,0.023 c0.039,0,0.077-0.004,0.116-0.004l-0.001,34.167c0,2.716,2.199,4.918,4.916,4.918c2.715,0,4.916-2.202,4.916-4.917l0.002-39.592 c0.644-1.193,1.019-2.544,1.019-4.025V50.893c1.331,3.322,2.467,7.888,3.429,14.457c0.304,2.067,2.079,3.557,4.111,3.557 c0.2,0,0.403-0.016,0.607-0.045c2.272-0.332,3.846-2.445,3.513-4.719C42.353,47.176,38.585,39.911,29.338,34.239z M22.188,56.147 l-2.585-3.536l2.001-13.38c0.2-0.538,0.286-1.11,0.251-1.687l0.333-2.207h0.05l2.585,17.274l-2.585,3.536H22.188z"></path> <circle cx="101.28" cy="20.915" r="10.716"></circle> <path d="M123.907,64.141c-2.487-16.964-6.256-24.229-15.5-29.901c-0.18-0.11-0.369-0.188-0.559-0.269 c-1.191-0.796-2.533-1.382-3.899-1.718l-2.669,2.687l-2.59-2.716c-0.009,0.002-0.017,0.002-0.025,0.005 c-1.981,0.473-3.905,1.477-5.409,2.888c-8.261,5.556-11.78,12.919-14.143,29.024c-0.333,2.272,1.238,4.387,3.512,4.719 c0.205,0.031,0.408,0.045,0.607,0.045c2.032,0,3.81-1.488,4.111-3.557c0.85-5.795,1.833-10.03,2.968-13.229v13.101 c0,1.119,0.218,2.162,0.6,3.123c-0.03,0.217-0.052,0.436-0.052,0.659l0.004,39.835c0,2.715,2.2,4.917,4.917,4.917 c2.716-0.001,4.916-2.202,4.916-4.918l-0.005-34.187c0.196,0.009,0.392,0.023,0.589,0.023c0.037,0,0.076-0.004,0.113-0.004 l-0.002,34.167c0,2.716,2.202,4.918,4.917,4.918c2.716,0,4.917-2.202,4.917-4.917l0.001-39.592 c0.645-1.193,1.021-2.544,1.021-4.025V50.893c1.331,3.322,2.465,7.888,3.429,14.457c0.303,2.067,2.08,3.557,4.109,3.557 c0.2,0,0.403-0.016,0.609-0.045C122.667,68.527,124.24,66.414,123.907,64.141z M101.253,56.147l-2.584-3.536l2.003-13.38 c0.199-0.538,0.285-1.11,0.252-1.687l0.329-2.207h0.051l2.583,17.274l-2.583,3.536H101.253z"></path> <polygon points="64.706,43.259 49.608,43.259 49.608,49.021 64.706,49.021 64.706,54.494 74.457,46.139 64.706,37.786 "></polygon> <polygon points="59.356,51.893 49.607,60.247 59.356,68.602 59.356,63.127 74.456,63.127 74.456,57.366 59.356,57.366 "></polygon> </g> </g> </g></svg>
                        </div>
                        @if($transaction->type == 1)
                                <h6 class="mb-4 text-center text-success">+{{number_format($transaction->amount)}} <small>MMK</small></h6>
                            @elseif($transaction->type == 2)
                                <p class="mb-4 text-center text-danger">-{{number_format($transaction->amount)}} <small>MMK</small></p>
                        @endif
                        <div class="d-flex justify-content-between">
                            <p class="text-muted mb-0">Trx ID</p>
                            <p class="mb-0">{{ $transaction->trx_no }}</p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <p class="text-muted mb-0">Reference Number</p>
                            <p class="mb-0">{{ $transaction->ref_no }}</p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <p class="text-muted mb-0">Type</p>
                            <p class="mb-0">
                                    @if($transaction->type == 1)
                                        <span class="badge rounded-pill bg-success">Income</span>
                                    @elseif($transaction->type == 2)
                                        <span class="badge rounded-pill bg-danger">Expense</span>
                                    @endif       
                            </p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <p class="text-muted mb-0">Amount</p>
                            <p class="mb-0">{{number_format($transaction->amount)}} MMK</p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <p class="text-muted mb-0">Date and Time</p>
                            <p class="mb-0">{{ $transaction->created_at }}</p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <p class="text-muted mb-0">
                                    @if($transaction->type == 1)
                                        <span class="text-success">From</span>
                                        @elseif($transaction->type == 2)
                                        <span class="text-danger">To</span>
                                    @endif 
                            </p>
                            <p class="mb-0">{{ $transaction->Source ? $transaction->Source->name : '-' }}</p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <p class="text-muted mb-0">Description</p>
                            <p class="mb-0">{{ $transaction->description }}</p>
                        </div>
                        </div>
                    </div>
               </div>
</div> 
@endsection