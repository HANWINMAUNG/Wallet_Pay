@extends('backend.layouts.app')
@section('wallet','active')
@section('content')
<main class="content">
				<div class="container-fluid p-0">
					<h1 class="h3 mb-3"><strong>Wallet</strong></h1>
					<div class="py-3 d-flex flex-row-reverse">
					    <a href="{{ route('remove.amount') }}" class="btn btn-danger">Cash Out <i class="align-middle" data-feather="minus"></i></a>
						<a href="{{ route('add.amount') }}" class="btn btn-secondary" style="margin-right:10px;">Cash In <i class="align-middle" data-feather="plus-circle"></i></a>
					</div>
                    <div class="">
						<div class="card">
							<div class="card-body">
									<div class = "p-2">
										<table class = "table table-hover" id="data-table" style="width:100%;">
											<thead>
												<tr>
													<th style="">Account Number</th>
													<th style="">Account Person</th>
													<th style="">Ammount (MMK)</th>
													<th style="">Joined Date</th>
													<th style="">Updated Date</th>													
												</tr>
											</thead>
											<tbody class = "">
											</tbody>
										</table>
									</div>
							</div>
						</div>
					</div>				
				</div>
</main> 
@endsection
@push('script')
<script type="text/javascript">

		$(function () {

		var table = new DataTable('#data-table',{
			
			scrollX: true,

			processing: true,

			serverSide: true,

			ajax: "{{ route('wallet.index') }}",

			order: [
				[4,'desc']
			],

			columns: [

				{data: 'account_number', name: 'account_number',class:'text-center'},

				{data: 'user_id', name: 'user_id',class:'text-center'},

				{data: 'amount', name: 'amount',class:'text-center'},

				{data: 'created_at', name: 'created_at',class:'text-center',searchable: false,sortable:false},

				{data: 'updated_at', name: 'updated_at',class:'text-center',searchable: false,sortable:false},
				
			]
		});	
		});
</script>
@endpush