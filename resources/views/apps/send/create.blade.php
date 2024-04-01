@extends('layouts.index')
@section('content')
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="fa fa-send bg-c-green"></i>
					<div class="d-inline">
						<h5>ส่งข้อมูล</h5>
						<span>ข้อมูลจำเป็นสำหรับการส่ง APIs</span>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="page-header-breadcrumb">
					<ul class=" breadcrumb breadcrumb-title">
						<li class="breadcrumb-item">
							<a href=""><i class="feather icon-home"></i></a>
						</li>
						<li class="breadcrumb-item"><a href="#!">ส่งข้อมูล</a></li>
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
								<div class="card-header">
									<h5>ส่งข้อมูล D506</h5>
								</div>
								<div class="card-block">
									<form id="sendD506" action="#" method="POST" enctype="multipart/form-data">
										<div class="row">
											<label class="col-sm-4 col-lg-2 col-form-label">Token Expire Date</label>
											<div class="col-sm-8 col-lg-10">
												<div class="input-group input-group-info">
													<span class="input-group-prepend">
														<label class="input-group-text"><i class="fa fa-clock-o"></i></label>
													</span>
													<input type="text" name="moph_token_enpoint" value="{{ $data['moph_token_expire'] }}" class="form-control" placeholder="API-Token" readonly>
												</div>
											</div>
										</div>
										<div class="row">
											<label class="col-sm-4 col-lg-2 col-form-label">Token URL</label>
											<div class="col-sm-8 col-lg-10">
												<div class="input-group input-group-info">
													<span class="input-group-prepend">
														<label class="input-group-text"><i class="ti-link"></i></label>
													</span>
													<input type="hidden" name="_token" value="{{ csrf_token() }}">
													<input type="text" name="moph_token_enpoint" value="{{ $data['moph_token_enpoint'] ?? env('MOPH_TOKEN_URL') }}" class="form-control" placeholder="API-Token" readonly>
												</div>
											</div>
										</div>
										<div class="row">
											<label class="col-sm-4 col-lg-2 col-form-label">API URL</label>
											<div class="col-sm-8 col-lg-10">
												<div class="input-group input-group-info">
													<span class="input-group-prepend">
														<label class="input-group-text"><i class="ti-link"></i></label>
													</span>
													<input type="text" name="moph_send_506_enpoint" value="{{ $data['moph_send_506_enpoint'] ?? env('MOPH_SEND_506_URL') }}" class="form-control" placeholder="API Enpoint" readonly>
												</div>
											</div>
										</div>
										<div class="row">
											<label class="col-sm-4 col-lg-2 col-form-label">Hospital Code:</label>
											<div class="col-sm-8 col-lg-10">
												<div class="input-group input-group-info">
													<span class="input-group-prepend">
														<label class="input-group-text"><i class="ti-flag"></i></label>
													</span>
													<input type="text" name="hosp_code" value="{{ $data['hosp_code'] ?? env('HOSP_CODE') }}" class="form-control" placeholder="Hospital code" readonly>
												</div>
											</div>
										</div>
										<div class="row">
											<label class="col-sm-4 col-lg-2 col-form-label">MOPH-IC Username</label>
											<div class="col-sm-8 col-lg-10">
												<div class="input-group input-group-info">
													<span class="input-group-prepend">
														<label class="input-group-text"><i class="ti-user"></i></label>
													</span>
													<input type="text" name="moph_username" value="{{ $data['moph_username'] ?? env('HOSP_USER') }}" class="form-control" placeholder="MOPH-IC User" readonly>
												</div>
											</div>
										</div>
										<div class="row">
											<label class="col-sm-4 col-lg-2 col-form-label">&nbsp;</label>
											<div class="col-sm-8 col-lg-10">
												<div class="text-left mt-4">
													<button type="submit" class="btn btn-danger" id="btn_submit">
														<i class="fa fa-send"></i>
														ส่งข้อมูลจาก HIS ไปยัง DDS
														<span id="spinner">
															<i class="fa fa-spinner fa-spin fa-fw"></i>
															<span class="sr-only">Loading...</span>
														</span>
													</button>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@push('script')
<script type="text/javascript">
$(document).ready(function() {
	$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
	$('#spinner').hide();
});
</script>
<script type="text/javascript">
$('#sendD506').on('submit', function(e) {
	e.preventDefault();
	$('#spinner').show();
	$('#btn_submit').prop('disabled', true);
	$.ajax({
		method: "POST",
		url: "{{ route('d506.send.to.dds') }}",
		dataType: "json",
		success: function(data, textStatus, jqXHR) {
			if (data.textStatus == 'success') {
				$('#btn_submit').prop('disabled', false);
				$('#spinner').hide();
				Swal.fire({
					icon: 'success',
					title: 'Completed',
					html: data.message,
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
			} else {
				$('#btn_submit').prop('disabled', false);
				$('#spinner').hide();
				Swal.fire({
					icon: 'error',
					title: 'Error',
					html: data.message,
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
			}
		},
		error: function (jqXHR, textStatus, errorThrown) {
			console.log("jqXHR:" + jqXHR);
			console.log("TextStatus: " + textStatus);
			console.log("ErrorThrown: " + errorThrown);
		}
	});
});
</script>
@endpush
