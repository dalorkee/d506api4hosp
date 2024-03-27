<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="D506 for hospital">
	<meta name="keywords" content="d506, d506-API">
	<meta name="author" content="talek-team">
	<title>{{ config('APP_NAME') }}</title>
	@include('layouts.style')
	@yield('style')
	<style type="text/css">
		.swal2-popup, .swal2-popup > * {font-family: 'Prompt' !important;background: #f4f4f4 !important}
		.swal-title {color: #164e7c !important; font-size: 1.20rem; font-weight: 400;}
		.swal-footer {text-align: center !important}
		.swal-btn {
			background-color: #30cfcf !important;
			border: 1px solid #beeef7 !important;
			border-radius: .5rem !important;
			box-sizing: border-box !important;
			color: #ffffff !important;
			font-family: "Prompt" !important;
			font-size: .875rem !important;
			font-weight: 400 !important;
			line-height: 1.25rem !important;
			padding: .75rem 1rem !important;
			text-align: center !important;
			text-decoration: none #D1D5DB solid !important;
			text-decoration-thickness: auto !important;
			/* box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important; */
			cursor: pointer !important;
			user-select: none !important;
			-webkit-user-select: none !important;
			touch-action: manipulation !important;
		}
		.swal-btn:hover {background-color: #1dbbbb !important}
		.swal-btn:focus {outline: 2px solid transparent !important; outline-offset: 2px !important}
		.swal-btn:focus-visible {box-shadow: none !important}
		.datepicker td,th {
			text-align: center;
			margin-top: 0;
			padding: 8px 12px;
			font-size: 14px;
		}
		label {color:#333;font-weight:400!important}
		.flu-btn {width:160px;padding:10px}
		input {font-size:1em !important}
		input:read-only {background-color:#FFF6EF!important}
		input:disabled {background-color:#f4f4f4!important}
		.dropdown.bootstrap-select {font-size:1em!important;background:red!important}
		.dropdown.bootstrap-select:after {clear:both!important;display:block!important}
		/* .input-group {margin:0!important;padding:0!important;} */
		/* .input-group-append {padding-left:14px;width:40px;background-color:#1dbbbb;color:white} */
		.input-group-text {height: 42px!important;}
		.btn-light {border:1px solid #ccc!important;background: white}
	</style>
</head>
<body>
<div class="loader-bg">
	<div class="loader-bar"></div>
</div>
<div id="pcoded" class="pcoded font-prompt">
	<div class="pcoded-overlay-box"></div>
	<div class="pcoded-container navbar-wrapper">
		<nav class="navbar header-navbar pcoded-header theme5">
			<div class="navbar-wrapper">
				<div class="navbar-logo">
					<img src="{{ URL::asset('png/logo.png') }}" style="margin-left: 20px; width: 40px" />
					<a href="#">{{ config('app.name') }} 1.0</a>
					<a class="mobile-menu" id="mobile-collapse" href="#!"><i class="feather icon-menu icon-toggle-right"></i></a>
					<a class="mobile-options waves-effect waves-light"><i class="feather icon-more-horizontal"></i></a>
				</div>
				<div class="navbar-container container-fluid">
					<ul class="nav-left">
						<li>
							<a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
								<i class="full-screen feather icon-maximize"></i>
							</a>
						</li>
					</ul>
					<ul class="nav-right">
						<li class="user-profile header-notification">
							<div class="dropdown-primary dropdown">
								<div class="dropdown-toggle" data-toggle="dropdown">
									<img src="{{ URL::asset('png/avartar.png') }}" class="img-radius" alt="User-Profile-Image">
									<span>{{ auth()->user()->first_name ?? 'Guest' }}</span>
									<i class="feather icon-chevron-down"></i>
								</div>
								<ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
									<li><a href="#"><i class="feather icon-user"></i> Profile</a></li>
									<li><a href="{{ route('logout') }}"><i class="feather icon-log-out"></i> Logout</a></li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="pcoded-main-container">
			<div class="pcoded-wrapper">
				@include('layouts.navigation')
			</div>
			<div class="pcoded-content">
				@if ($errors->any())
					<div class="alert alert-danger border-danger m-4">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<i class="fa fa-times"></i>
						</button>
						<ul>
							@foreach ($errors->all() as $error)
								<li><strong>{{ $error }}</strong></li>
							@endforeach
						</ul>
					</div>
				@endif
				@yield('content')
			</div>
		</div>
	</div>
	<div id="styleSelector"></div>
</div>
@include('layouts.script')
<script type="text/javascript">
$(document).ready(function() {
	$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
	@if (Session::has('success'))
		Swal.fire({
			type: 'success',
			icon: 'success',
			title: 'สำเร็จ',
			html: "{{ Session::get('success') }}",
			showCloseButton: true,
			confirmButtonText: "ตกลง",
			footer: "D506 API",
			allowOutsideClick: false,
			customClass: {
				confirmButton: 'swal-btn',
				title: 'swal-title',
				icon: 'icon-class',
				footer: 'swal-footer',
			}
		});
		@php Session::forget("success"); @endphp
	@elseif (Session::has('error'))
		Swal.fire({
			type: 'error',
			icon: 'error',
			title: 'ผิดพลาด',
			html: "{{ Session::get('error') }}",
			showCloseButton: true,
			confirmButtonText: "ตกลง",
			footer: "D506 API",
			allowOutsideClick: false,
			customClass: {
				confirmButton: 'swal-btn',
				title: 'swal-title',
				icon: 'icon-class',
				footer: 'swal-footer',
			}
		});
		@php Session::forget("error"); @endphp
	@endif
});
</script>
@stack('script')
</body>
</html>
