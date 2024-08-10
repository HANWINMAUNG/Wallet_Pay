@extends('backend.layouts.app')
@section('transaction','active')
@section('content')
<main class="content">
				<div class="container-fluid p-0">
					<h1 class="h3 mb-3"><strong>Transactions</strong></h1>
                    <div class="">
						<div class="card">
							<div class="card-body">
									<div class = "p-2">
										<table class = "table table-hover" id="data-table" style="width:100%;">
											<thead>
												<tr>
													<!-- <th style="">Ref No</th> -->
													<th style="">Transaction No</th>
													<th style="">User Phone</th>
													<th style="">Type</th>
													<th style="">Amount</th>
													<th style="">Pay&Receive Phone</th>
													<th style="">Transaction Date</th>
													<th style="">Actions</th>													
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

			ajax: "{{ route('transaction.index') }}",

			order: [
				[6,'desc']
			],

			columns: [

				// {data: 'ref_no', name: 'ref_no',class:'text-center',searchable: true},

				{data: 'trx_no', name: 'trx_no',class:'text-center'},

				{data: 'user_id', name: 'user_id',class:'text-center',searchable: true},

				{data: 'type', name: 'type',class:'text-center',searchable: true},

				{data: 'amount', name: 'amount',class:'text-center'},

				{data: 'source_id', name: 'source_id',class:'text-center'},

				{data: 'created_at', name: 'created_at',class:'text-center',searchable: false,sortable:false},

				{data: 'action', name: 'action',class:'text-center',searchable: false,sortable:false},
				
			]
		}); 
		
		});
</script>
@endpush