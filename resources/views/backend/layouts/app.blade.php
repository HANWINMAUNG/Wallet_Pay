<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
    
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="{{ asset('backend/assets/img/m_pay_logo.svg') }}" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <meta name="csrf-token" content="{{csrf_token()}}">
	<title>M_Pay</title>

	<link href="{{ asset('backend/assets/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('backend/assets/css/bootstrap5.min.css') }}" rel="stylesheet">
	<link href="{{ asset('backend/assets/css/jquery.dataTables.min.css') }}" rel="stylesheet">
	
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    @stack('header')
</head>

<body>
	<div class="wrapper">
		@include('backend.layouts.side')
		<div class="main">
			@include('backend.layouts.nav')
			@yield('content')
			@include('backend.layouts.footer')
		</div>
	</div>

	<script src="{{ asset('backend/assets/js/app.js') }}"></script>
	<script src="{{ asset('backend/assets/js/code.js') }}"></script>
	<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
	<script src="{{ asset('backend/assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('backend/assets/js/sweetalert2.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js') }}"></script>

	
	<script>
		$(document).ready(function(){
			let token = document.head.querySelector('meta[name="csrf-token"]');
				if(token){
					$.ajaxSetup({
						headers : {
							'X-CSRF-TOKEN' : token.content
						}
					});
				}

			$('.back-btn').on('click' , function(){
				window.history.go(-1);
				return false;
			});
			const Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 3000,
			timerProgressBar: true,
			didOpen: (toast) => {
				toast.addEventListener('mouseenter', Swal.stopTimer)
				toast.addEventListener('mouseleave', Swal.resumeTimer)
			}
			})
             @if(session('success'))
			Toast.fire({
			icon: 'success',
			title: "{{ session('success') }}"
			})
			@endif
		});
	</script>
    @stack('script')
</body>

</html>