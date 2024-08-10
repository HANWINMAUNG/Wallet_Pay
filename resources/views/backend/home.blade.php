@extends('backend.layouts.app')
@section('home','active')
@section('content')
        <main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>M Pay Dashboard</strong></h1>

					<div class="row">
						<div class=" d-flex">
							<div class="w-100">
								<div class="row">
									<div class="col-3">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Admin Total</h5>
													</div>
													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="users"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3">{{ $admin_user }}</h1>
											</div>
										</div>
									</div>
									<div class="col-3">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">User Total</h5>
													</div>
													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="users"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3">{{ $user }}</h1>
											</div>
										</div>
									</div>
									<div class="col-3">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Wallet Total</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="credit-card"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3">{{ $wallet }}</h1>
											</div>
										</div>
									</div>
									<div class="col-3">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Transaction Total</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="credit-card"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3">{{ $transaction }}</h1>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 offset-md-3 ">
							<div class="card">
								<div class="card-body">
                                      <div class="text-center">
										@if(!auth()->user()->image == '')
											<img src="{{asset('images/' . auth()->user()->image)}}" alt=""  class="avatar img-fluid rounded-3 me-1" style="width:300px;height:200px;padding:10px;object-fit:contain;">
										@else
											<img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" class="avatar img-fluid rounded-3 me-1"  style="width:300px;height:200px;padding:5px;object-fit:contain;" alt="https://ui-avatars.com/api/?" /> <span class="text-dark"></span>
										@endif
										
									  </div>
									  <div class="mt-4">
                                            <div class=""><span style="padding-right:40px;font-size:20px;">Name</span><span><span>-</span> {{auth()->user()->name}}</span></div>
											<div class=""><span style="padding-right:40px;font-size:20px;">Email</span><span><span>-</span>  {{auth()->user()->email}}</span></div>
											<div class=""><span style="padding-right:40px;font-size:20px;">Phone</span><span><span>-</span>  {{auth()->user()->phone}}</span></div>
                                      </div>
								</div>
							</div>
						</div>
					</div>

				</div>
		</main> 
@endsection