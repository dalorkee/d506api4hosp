@extends('layouts.index')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/dataTables.bootstrap4.min.css') }}">
<style rel="stylesheet" type="text/css">
#d506-table {width: 100%!important}
.strip1 {background-color: #f9f9f9 !important;}
.strip2 {background-color: #f4f4f4 !important;}
</style>
@endsection
@section('content')
<div class="page-header card">
	<div class="row align-items-end">
		<div class="col-lg-8">
			<div class="page-header-title">
				<i class="feather icon-home bg-c-blue"></i>
				<div class="d-inline">
					<h5>รายงานการส่งข้อมูล</h5>
					<span>รายการข้อมูลที่ถูกส่งออกจาก HIS</span>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="page-header-breadcrumb">
				<ul class=" breadcrumb breadcrumb-title">
					<li class="breadcrumb-item">
						<a href=""><i class="feather icon-home"></i></a>
					</li>
					<li class="breadcrumb-item"><a href="#!">รายงาน</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="pcoded-inner-content">
	<div class="main-body">
		<div class="page-wrapper">
			<div class="page-body">
				<div class="row">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-block">
								<div class="table table-responsive">
									{{ $dataTable->table() }}
								</div>
							</div>
						</div>
					</div>
				</div>
				<div
					id="d506-modal"
					class="modal"
					data-easein="shake"
					data-backdrop="static"
					tabindex="-1"
					role="dialog"
					aria-labelledby="costumModalLabel"
					aria-hidden="true"
				>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('script')
{{ $dataTable->scripts() }}
<script type="text/javascript" src="{{ URL::asset('js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/dataTables.bootstrap4.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/modal.effect.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/modal.center.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/velocity.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/velocity.ui.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
	$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
});
function send(data) {
	$.ajax({
		method: "GET",
		url: "{{ route('d506.report.create') }}",
		data: {data: data},
		success: function(response) {
			$('#d506-modal').html(response);
			$('#d506-modal').modal('show');
		},
		error: function(xhr, status, message) {
			console.log(`${status}, code:${xhr.status}, ${message}`);
		}
	});
}
function sendToQueue(id) {
	let data_id = `data_${id}`;
	document.getElementById(data_id).disabled = true;
	let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
	let route = "{{ route('d506.send.to.queue') }}";
	fetch(route, {
		method: 'POST',
		headers: {
			"Content-Type": "application/json",
			"Accept": "application/json, text-plain, */*",
			"X-Requested-With": "XMLHttpRequest",
			'X-CSRF-TOKEN': token
		},
		credentials: "same-origin",
		body: JSON.stringify({id: id})
	})
	.then(response => response.text())
	.then(function(data) {
		if (data === 'processing') {
			let btn = document.querySelector('#'+data_id);
			let el = document.createElement('div');
			el.textContent = "On queue";
			btn.replaceWith(el);
		}
	});
}
</script>
@endpush
