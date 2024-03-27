@extends('layouts.index')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/chartist.css') }}" media="all">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/widget.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}">
@endsection
@section('content')
<div class="page-header card">
	<div class="row align-items-end">
		<div class="col-lg-8">
			<div class="page-header-title">
				<i class="feather icon-home bg-c-blue"></i>
				<div class="d-inline">
					<h5>Dashboard</h5>
					<span></span>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="page-header-breadcrumb">
				<ul class=" breadcrumb breadcrumb-title">
					<li class="breadcrumb-item">
						<a href="index.html"><i class="feather icon-home"></i></a>
					</li>
					<li class="breadcrumb-item"><a href="#!">Dashboard</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="pcoded-inner-content">
	<div class="main-body">
		<div class="page-wrapper">
			<div class="page-body">
				<livewire:dashboard.counter />
			</div>
		</div>
	</div>
</div>
@endsection
@push('script')
<script type="text/javascript" src="{{ URL::asset('js/jquery.flot.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/jquery.flot.categories.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/curvedlines.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/jquery.flot.tooltip.min.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('js/amcharts.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/gauge.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/serial.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/light.js') }}"></script>
{{-- <script type="text/javascript" src="{{ URL::asset('js/pie.min.js') }}"></script> --}}
{{-- <script type="text/javascript" src="{{ URL::asset('js/ammap.min.js') }}"></script> --}}
<script type="text/javascript" src="{{ URL::asset('js/usalow.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/chartist.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/analytic-dashboard.min.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('js/vertical-layout.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/pcoded.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/script.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/rocket-loader.min.js') }}"></script>
@endpush
