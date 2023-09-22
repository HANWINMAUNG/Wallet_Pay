@extends('backend.layouts.app')
@section('admin_user','active')
@section('content')
<main class="content">
				<div class="container-fluid p-0">
					<h1 class="h3 mb-3"><strong>Admin User</strong></h1>
					<div class="py-3 d-flex flex-row-reverse">
						<a href="{{ route('admin-user.create') }}" class="btn btn-secondary">Admin User Create <i class="align-middle" data-feather="plus-circle"></i></a>
					</div>
                    <div class="">
						<div class="card">
							<div class="card-body">
									<div class = "p-2">
										<table class = "table table-hover" id="data-table" style="width:100%;">
											<thead>
												<tr>
													<th style="">Admin Name</th>
													<th style="">Email</th>
													<th style="">Phone</th>
													<th style="">IP</th>
													<th style="">User Agent</th>
													<th style="">Joined Date</th>
													<th style="">Updated Date</th>
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

			processing: true,

			serverSide: true,

			ajax: "{{ route('admin-user.index') }}",

			order: [
				[6,'desc']
			],

			columns: [

				{data: 'name', name: 'name',class:'text-center'},

				{data: 'email', name: 'email',class:'text-center'},

				{data: 'phone', name: 'phone',class:'text-center'},

				{data: 'ip', name: 'ip',class:'text-center'},

				{data: 'user_agent', name: 'user_agent',class:'text-center'},

				{data: 'created_at', name: 'created_at',class:'text-center',searchable: false,sortable:false},

				{data: 'updated_at', name: 'updated_at',class:'text-center',searchable: false,sortable:false},

				{data: 'action', name: 'action',class:'text-center',searchable: false,sortable:false},
				
			]
		}); 
		$(document).on('click','.delete',function(e){
			e.preventDefault();
			var id = $(this).data('id');
			Swal.fire({
				title: 'Are you sure,you want to delete?',
				showCancelButton: true,
				confirmButtonText: 'Confirm',
				}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
                          url : '/admin/admin-user/' + id,
						  type : 'DELETE',
						  success : function(){
							table.ajax.reload();
						  }
					});
				}
				})
		});
		
		});
</script>
@endpush