@extends('layouts.index')
@section('content')
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="feather icon-wifi bg-c-blue"></i>
					<div class="d-inline">
						<h5>ตั้งค่า APIs</h5>
						<span>ข้อมูลจำเป็นสำหรับเชื่อมต่อกับเซิร์ฟเวอร์</span>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="page-header-breadcrumb">
					<ul class=" breadcrumb breadcrumb-title">
						<li class="breadcrumb-item">
							<a href=""><i class="feather icon-home"></i></a>
						</li>
						<li class="breadcrumb-item"><a href="#!">ตั้งค่า APIs</a></li>
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
									<h5>ตั้งค่าการเชื่อมต่อ</h5>
								</div>
								<div class="card-block">
									<form action="{{ route('d506.config.store') }}" method="POST" enctype="multipart/form-data">
										<div class="row">
											<label class="col-sm-4 col-lg-2 col-form-label">Token URL</label>
											<div class="col-sm-8 col-lg-10">
												<div class="input-group">
													<span class="input-group-prepend">
														<label class="input-group-text"><i class="ti-link"></i></label>
													</span>
													<input type="hidden" name="_token" value="{{ csrf_token() }}">
													<input type="text" name="moph_token_enpoint" value="{{ $data['moph_token_enpoint'] ?? env('MOPH_TOKEN_URL') }}" class="form-control" placeholder="API-Token">
												</div>
											</div>
										</div>
										<div class="row">
											<label class="col-sm-4 col-lg-2 col-form-label">API URL</label>
											<div class="col-sm-8 col-lg-10">
												<div class="input-group">
													<span class="input-group-prepend">
														<label class="input-group-text"><i class="ti-target"></i></label>
													</span>
													<input type="text" name="moph_send_506_enpoint" value="{{ $data['moph_send_506_enpoint'] ?? env('MOPH_SEND_506_URL') }}" class="form-control" placeholder="API Enpoint">
												</div>
											</div>
										</div>
										<div class="row">
											<label class="col-sm-4 col-lg-2 col-form-label">Hospital Code:</label>
											<div class="col-sm-8 col-lg-10">
												<div class="input-group">
													<span class="input-group-prepend">
														<label class="input-group-text"><i class="ti-flag"></i></label>
													</span>
													<input type="text" name="hosp_code" value="{{ $data['hosp_code'] ?? env('HOSP_CODE') }}" class="form-control" placeholder="Hospital code">
												</div>
											</div>
										</div>
										<div class="row">
											<label class="col-sm-4 col-lg-2 col-form-label">MOPH-IC Username</label>
											<div class="col-sm-8 col-lg-10">
												<div class="input-group">
													<span class="input-group-prepend">
														<label class="input-group-text"><i class="ti-user"></i></label>
													</span>
													<input type="text" name="moph_username" value="{{ $data['moph_username'] ?? env('HOSP_USER') }}" class="form-control" placeholder="MOPH-IC User">
												</div>
											</div>
										</div>
										<div class="row">
											<label class="col-sm-4 col-lg-2 col-form-label">MOPH-IC Password</label>
											<div class="col-sm-8 col-lg-10">
												<div class="input-group">
													<span class="input-group-prepend">
														<label class="input-group-text"><i class="ti-unlock"></i></label>
													</span>
													<input type="text" name="moph_password" value="{{ $data['moph_password'] ?? env('HOSP_PASSWORD') }}" class="form-control" placeholder="MOPH-IC Password">
												</div>
											</div>
										</div>
										<div class="row">
											<label class="col-sm-4 col-lg-2 col-form-label">Hash code</label>
											<div class="col-sm-8 col-lg-10">
												<div class="input-group">
													<span class="input-group-prepend">
														<label class="input-group-text"><i class="ti-unlock"></i></label>
													</span>
													<input type="text" name="moph_password_hash" value="{{ $data['moph_password_hash'] ?? '' }}" class="form-control" readonly placeholder="Hash">
												</div>
											</div>
										</div>
										<div class="row">
											<label class="col-sm-4 col-lg-2 col-form-label">สถานะการเชื่อมต่อ</label>
											<div class="col-sm-8 col-lg-10">
												<div class="input-group input-group-info">
													<span class="input-group-prepend">
														<label class="input-group-text"><i class="ti-link"></i></label>
													</span>
													<input type="text" name="moph_username" value="พร้อมส่งข้อมูล" class="form-control" placeholder="Status" readonly>
												</div>
											</div>
										</div>
										<div class="row">
											<label class="col-sm-4 col-lg-2 col-form-label">&nbsp;</label>
											<div class="col-sm-8 col-lg-10">
												<div class="text-left mt-4">
													<button type="submit" class="btn btn-success"><i class="fa fa-save"></i>บันทึกข้อมูล</button>
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
});
</script>
@endpush
