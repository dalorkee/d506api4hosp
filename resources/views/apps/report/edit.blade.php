@extends('layouts.index')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bs-select/bootstrap-select.min.css') }}">
{{-- <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap-datepicker.min.css') }}"> --}}
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap-datetimepicker.min.css') }}">
@endsection
@section('content')
<div class="page-header card">
	<div class="row align-items-end">
		<div class="col-lg-8">
			<div class="page-header-title">
				<i class="fa fa-pencil bg-c-red"></i>
				<div class="d-inline">
					<h5>แก้ไขข้อมูล</h5>
					<span>ข้อมูลที่เตรียมส่งไปยังระบบ DDS</span>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="page-header-breadcrumb">
				<ul class=" breadcrumb breadcrumb-title">
					<li class="breadcrumb-item"><a href=""><i class="feather icon-home"></i></a></li>
					<li class="breadcrumb-item"><a href="#!">รายงาน</a></li>
					<li class="breadcrumb-item"><a href="#!">แก้ไขข้อมูล</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="pcoded-inner-content">
	<div class="main-body">
		<div class="page-wrapper">
			<div class="page-body">
				<form action="{{ route('d506.report.store') }}" method="POST">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							<div class="card" style="border:1px solid #BEADFA;">
								<div class="card-header">
									<h5 class="card-title" style="font-family:Prompt;font-weight:400;color:#a644b8">1. ข้อมูลทั่วไปของผู้ป่วย</h5>
								</div>
								<div class="card-block">
									<div class="row">
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">รหัสหน่วยบริการ<span class="text-danger">*</span></label>
											@csrf
											<input type="hidden" name="id" value="{{ $id }}" />
											<input type="text" name="hospital_code" value="{{ $d506['hospital']['hospital_code'] }}" class="form-control form-control-lg" readonly />
											@error('hospital_code')<div><span class="text-danger">{{ $message }}</span></div>@enderror
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">ชื่อหน่วยบริการ<span class="text-danger">*</span></label>
											<input type="text" name="hospital_name" value="{{ $d506['hospital']['hospital_name'] }}" class="form-control form-control-lg" readonly />
											@error('hospital_name')<div><span class="text-danger">{{ $message }}</span></div>@enderror
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">HIS Identifier</label>
											<input type="text" name="his_identifier" value="{{ $d506['hospital']['his_identifier'] }}" class="form-control form-control-lg" />
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">CID<span class="text-danger">*</span></label>
											<input type="text" name="cid" value="{{ $d506['person']['cid'] }}" class="form-control form-control-lg" />
											@error('cid')<div><span class="text-danger">{{ $message }}</span></div>@enderror
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">Passport</label>
											<input type="text" name="passport_no" class="form-control form-control-lg" value="{{ $d506['person']['passport_no'] }}" />
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">คำนำหน้าชื่อ<span class="text-danger">*</span></label>
											<select name="prefix" class="form-control form-control-lg selectpicker show-tick" data-live-search="true" data-size="6">
												<option value="">-- โปรดเลือก --</option>
												@foreach ($titleName as $key => $value)
													<option value="{{ $value }}" {{ ($d506['person']['prefix'] == $value) ? "selected" : "" }}>{{ $value }}</option>
												@endforeach
											</select>
											@error('prefix')<div><span class="text-danger">{{ $message }}</span></div>@enderror
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">ชื่อ<span class="text-danger">*</span></label>
											<input type="text" name="first_name" value="{{ $d506['person']['first_name'] }}" class="form-control form-control-lg" />
											@error('first_name')<div><span class="text-danger">{{ $message }}</span></div>@enderror
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">นามสกุล<span class="text-danger">*</span></label>
											<input type="text" name="last_name" value="{{ $d506['person']['last_name'] }}" class="form-control form-control-lg" />
											@error('last_name')<div><span class="text-danger">{{ $message }}</span></div>@enderror
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">สัญชาติ</label>
											<select name="nationality" class="form-control form-control-lg selectpicker show-tick" data-live-search="true" data-size="6">
												<option value="">-- โปรดเลือก --</option>
												@foreach ($nations as $nation)
													<option value="{{ $nation['code'] }}" {{ ($nation['code'] == $d506['person']['nationality']) ? "selected" : "" }}>{{ $nation['nation'] }}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">เพศ<span class="text-danger">*</span></label>
											<select name="gender" class="form-control form-control-lg selectpicker show-tick">
												<option value="">-- โปรดเลือก --</option>
												@foreach ($gender as $key => $value )
													<option value="{{ $key }}" {{ ($d506['person']['gender'] == $key) ? "selected" : "" }}>{{ $value }}</option>
												@endforeach
											</select>
											@error('gender')<div><span class="text-danger">{{ $message }}</span></div>@enderror
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="col-form-label">วัน/เดือน/ปี เกิด<span class="text-danger">*</span></label>
											<div class="input-group date bs-datepicker">
												<input type="text" name="birth_date" value="{{ $d506['person']['birth_date'] }}" class="form-control form-control-lg" />
												<div class="input-group-addon input-group-append">
													<div class="input-group-text"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></div>
												</div>
											</div>
											@error('birth_date')<div><span class="text-danger">{{ $message }}</span></div>@enderror
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">อายุ (ปี)<span class="text-danger">*</span></label>
											<input type="text" name="age_y" value="{{ $d506['person']['age_y'] }}" class="form-control form-control-lg" />
											@error('age_y')<div><span class="text-danger">{{ $message }}</span></div>@enderror
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">อายุ (เดือน)<span class="text-danger">*</span></label>
											<input type="text" name="age_m" value="{{ $d506['person']['age_m'] }}" class="form-control form-control-lg" />
											@error('age_m')<div><span class="text-danger">{{ $message }}</span></div>@enderror
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">อายุ (วัน)<span class="text-danger">*</span></label>
											<input type="text" name="age_d" value="{{ $d506['person']['age_d'] }}" class="form-control form-control-lg" />
											@error('age_d')<div><span class="text-danger">{{ $message }}</span></div>@enderror
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">สถานภาพสมรส</label>
											<select name="marital_status_id" class="form-control form-control-lg selectpicker show-tick">
												<option value="">-- โปรดเลือก --</option>
												@foreach ($marital as $key => $value)
													<option value="{{ $key }}" {{ ($d506['person']['marital_status_id'] == $key) ? "selected" : "" }}>{{ $value }}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">ที่อยู่ปัจจุบัน<span class="text-danger">*</span></label>
											<input type="text" name="address" value="{{ $d506['person']['address'] }}" class="form-control form-control-lg" />
											@error('address')<div><span class="text-danger">{{ $message }}</span></div>@enderror
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">หมู่ที่</label>
											<input type="text" name="moo" value="{{ $d506['person']['moo'] }}" class="form-control form-control-lg" />
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">ถนน</label>
											<input type="text" name="road" value="{{ $d506['person']['road'] }}" class="form-control form-control-lg" />
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">จังหวัด<span class="text-danger">*</span></label>
											<select name="chw_code" class="form-control form-control-lg selectpicker show-tick mb-2" data-live-search="true" data-size="6">
												<option value="">-- โปรดเลือก --</option>
												@foreach ($provinces as $key => $value)
													<option value="{{ $key }}" {{ ($d506['person']['chw_code'] == $key) ? "selected" : "" }}>{{ $value }}</option>
												@endforeach
											</select>
											@error('chw_code')<div><span class="text-danger">{{ $message }}</span></div>@enderror
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">อำเภอ<span class="text-danger">*</span></label>
											<select name="amp_code" class="form-control form-control-lg selectpicker show-tick mb-2" data-live-search="true" data-size="6">
												<option value="">-- โปรดเลือก --</option>
												@foreach ($districts as $key => $value)
													<option value="{{ $value['district_id_2_digit'] }}" {{ ($d506['person']['amp_code'] == $value['district_id_2_digit']) ? "selected" : "" }}>{{ $value['district_name'] }}</option>
												@endforeach
											</select>
											@error('amp_code')<div><span class="text-danger">{{ $message }}</span></div>@enderror
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">ตำบล<span class="text-danger">*</span></label>
											<select name="tmb_code" class="form-control form-control-lg selectpicker show-tick mb-2" data-live-search="true" data-size="6">
												<option value="">-- โปรดเลือก --</option>
												@foreach ($sub_districts as $key => $value)
													<option value="{{ $value['sub_district_id_2_digit'] }}" {{ ($d506['person']['tmb_code'] == $value['sub_district_id_2_digit']) ? "selected" : "" }}>{{ $value['sub_district_name'] }}</option>
												@endforeach
											</select>
											@error('tmb_code')<div><span class="text-danger">{{ $message }}</span></div>@enderror
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">เบอร์โทรศัพท์</label>
											<input type="text" name="mobile_phone" value="{{ $d506['person']['mobile_phone'] }}" class="form-control form-control-lg" />
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">อาชีพ</label>
											<select name="occupation" class="form-control form-control-lg selectpicker show-tick" data-live-search="true" data-size="6">
												<option value="">-- โปรดเลือก --</option>
												@foreach ($occu as $key => $value)
													<option value="{{ $value['occu_code_43'] }}" {{ ($d506['person']['occupation'] == $value['occu_code_43']) ? "selected" : "" }}>{{ $value['occu_desc_43'] }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
							</div>

							<div class="card" style="border:1px solid #1dd1ec;">
								<div class="card-header">
									<h5 class="card-title" style="font-family:Prompt;font-weight:400;color:#056676">2. ข้อมูลการสอบสวนโรค</h5>
								</div>
								<div class="card-block">
									<div class="row">
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">Epidem GUID<span class="text-danger">*</span></label>
											<input type="text" name="epidem_report_guid" value="{{ $epidem_report_guid }}" class="form-control form-control-lg" readonly />
											@error('epidem_report_guid')<div><span class="text-danger">{{ $message }}</span></div>@enderror
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">รหัสกลุ่มโรคทางระบาดวิทยา<span class="text-danger">*</span></label>
											<input type="text" name="epidem_report_group_code" value="{{ $d506['epidem_report']['epidem_report_group_code'] }}" class="form-control form-control-lg" />
											@error('epidem_report_group_code')<div><span class="text-danger">{{ $message }}</span></div>@enderror
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">รหัสโรงพยาบาลที่กำลังรักษาตัว<span class="text-danger">*</span></label>
											<input type="text" name="treated_hospital_code" value="{{ $d506['epidem_report']['treated_hospital_code'] }}" class="form-control form-control-lg" />
											@error('treated_hospital_code')<div><span class="text-danger">{{ $message }}</span></div>@enderror
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">วัน/เวลา ที่รายงานโรค<span class="text-danger">*</span></label>
											<div class="input-group date bs-datetimepicker">
												<input type="text" name="report_datetime" value="{{ date('Y-m-d H:i:s', strtotime($d506['epidem_report']['report_datetime'])) }}" class="form-control form-control-lg" required />
												<div class="input-group-addon input-group-append">
													<div class="input-group-text"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></div>
												</div>
											</div>
											{{-- <div class="input-group">
												<input type="text" name="report_datetime" value="{{ $d506['epidem_report']['report_datetime'] }}" data-format="yyyy-MM-dd hh:mm:ss" class="form-control form-control-lg bs-datetimepicker" />
												<span class="input-group-append"><i class="fa fa-calendar"></i></span>
											</div> --}}
											@error('report_datetime')<div><span class="text-danger">{{ $message }}</span></div>@enderror
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">วันที่เริ่มมีอาการ</label>
											<div class="input-group date bs-datepicker">
												<input type="text" name="onset_date" value="{{ $d506['epidem_report']['onset_date'] }}" class="form-control form-control-lg" />
												<div class="input-group-addon input-group-append">
													<div class="input-group-text"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></div>
												</div>
											</div>
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">วันที่เริ่มรักษา</label>
											<div class="input-group date bs-datepicker">
												<input type="text" name="treated_date" value="{{ $d506['epidem_report']['treated_date'] }}" class="form-control form-control-lg" />
												<div class="input-group-addon input-group-append">
													<div class="input-group-text"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></div>
												</div>
											</div>
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">วันที่วินิจฉัยโรค</label>
											<div class="input-group date bs-datepicker">
												<input type="text" name="diagnosis_date" value="{{ $d506['epidem_report']['diagnosis_date'] }}" class="form-control form-control-lg" />
												<div class="input-group-addon input-group-append">
													<div class="input-group-text"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></div>
												</div>
											</div>
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">วันที่เสียชีวิต</label>
											<div class="input-group date bs-datepicker">
												<input type="text" name="death_date" value="{{ $d506['epidem_report']['death_date'] }}" class="form-control form-control-lg" />
												<div class="input-group-addon input-group-append">
													<div class="input-group-text"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></div>
												</div>
											</div>
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">สาเหตุการเสียชีวิต</label>
											<input type="text" name="cdeath" value="{{ $d506['epidem_report']['cdeath'] }}" class="form-control form-control-lg" />
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">ชื่อผู้รายงาน</label>
											<input type="text" name="informer_name" value="{{ $d506['epidem_report']['informer_name'] }}" class="form-control form-control-lg" />
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">ชนิดของเชื้อ <abbr title="อ้างอิงจากชนิดของเชื้อแต่ละกลุ่มโรค ตาราง epidem_organism"><i class="fa fa-info-circle"></i></abbr></label>
											<input type="text" name="organism" value="{{ $d506['epidem_report']['organism'] }}" class="form-control form-control-lg" />
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">ภาวะแทรกซ้อน <abbr title="อ้างอิงจากชนิดของภาวะแทรกซ้อนแต่ละกลุ่มโรค ตาราง epidem_complication"><i class="fa fa-info-circle"></i></abbr></label>
											<input type="text" name="complication" value="{{ $d506['epidem_report']['complication'] }}" class="form-control form-control-lg" />
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">รหัส ICD10 หลัก<span class="text-danger">*</span></label>
											<input type="text" name="principal_diagnosis_icd10" value="{{ $d506['epidem_report']['principal_diagnosis_icd10'] }}" class="form-control form-control-lg" />
											@error('principal_diagnosis_icd10')<div><span class="text-danger">{{ $message }}</span></div>@enderror
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">รหัส ICD10 รอง<span class="text-danger">*</span> <abbr title="กรณีมีเพียง principle_diagnosis ให้ส่งเป็นตัวเดียวกันเข้ามา และกรณีมีหลายรหัสให้คั่นด้วยคอมมา ,"><i class="fa fa-info-circle"></i></abbr></label>
											<input type="text" name="diagnosis_icd10_list" value="{{ $d506['epidem_report']['diagnosis_icd10_list'] }}" class="form-control form-control-lg" />
											@error('diagnosis_icd10_list')<div><span class="text-danger">{{ $message }}</span></div>@enderror
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">สภาพผู้ป่วย<span class="text-danger">*</span></label>
											<select name="epidem_person_status_id" class="form-control form-control-lg selectpicker show-tick" data-live-search="true" data-size="6">
												<option value="">-- โปรดเลือก --</option>
												@foreach ($person_status as $key => $value)
													<option value="{{ $d506['epidem_report']['epidem_person_status_id'] }}" {{ ($d506['epidem_report']['epidem_person_status_id'] == $key) ? "selected" : "" }}>{{ $value }}</option>
												@endforeach
											</select>
											@error('epidem_person_status_id')<div><span class="text-danger">{{ $message }}</span></div>@enderror
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">อาการที่แสดง <abbr title="อ้างอิงตาราง epidem_symptom_type"><i class="fa fa-info-circle"></i></abbr></label>
											<input type="text" name="epidem_symptom_type_id" value="{{ $d506['epidem_report']['epidem_symptom_type_id'] }}" class="form-control form-control-lg" />
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">เขตพื้นที่รักษาตัว (เทศบาล)<span class="text-danger">*</span> <abbr title="อ้างอิงตาราง epidem_municipal"><i class="fa fa-info-circle"></i></abbr></label>
											<input type="text" name="municipal" value="{{ $d506['epidem_report']['municipal'] }}" class="form-control form-control-lg" />
											@error('municipal')<div><span class="text-danger">{{ $message }}</span></div>@enderror
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">ใส่เครื่องช่วยหายใจ<span class="text-danger">*</span></label>
											<select name="respirator_status" class="form-control form-control-lg selectpicker show-tick" data-live-search="true" data-size="6">
												<option value="N">-- โปรดเลือก --</option>
												@foreach ($respirator_status as $key => $value)
													<option value="{{ $d506['epidem_report']['respirator_status'] }}" {{ ($d506['epidem_report']['respirator_status'] == $key) ? 'selected' : '' }}>{{ $value }}</option>
												@endforeach
											</select>
											@error('respirator_status')<div><span class="text-danger">{{ $message }}</span></div>@enderror
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">มีประวัติการได้รับวัคซีน</label>
											<select name="vaccinated_status" class="form-control form-control-lg selectpicker show-tick" data-live-search="true" data-size="6">
												<option value="">-- โปรดเลือก --</option>
												@foreach ($vaccinated_status as $key => $value)
													<option value="{{ $d506['epidem_report']['vaccinated_status'] }}" {{ ($d506['epidem_report']['vaccinated_status'] == $key) ? 'selected' : '' }}>{{ $value }}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">บ้านเลขที่ (ขณะสำรวจว่าเป็นโรค)</label>
											<input type="text" name="epidem_address" value="{{ $d506['epidem_report']['epidem_address'] }}" class="form-control form-control-lg" />
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">หมู่ที่ (ขณะสำรวจว่าเป็นโรค)</label>
											<input type="text" name="epidem_moo" value="{{ $d506['epidem_report']['epidem_moo'] }}" class="form-control form-control-lg" />
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">ถนน (ขณะสำรวจว่าเป็นโรค)</label>
											<input type="text" name="epidem_road" value="{{ $d506['epidem_report']['epidem_road'] }}" class="form-control form-control-lg" />
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">จังหวัด (ขณะสำรวจว่าเป็นโรค)<span class="text-danger">*</span></label>
											<select name="epidem_chw_code" class="form-control form-control-lg selectpicker show-tick" data-live-search="true" data-size="6">
												<option value="">-- โปรดเลือก --</option>
												@foreach ($provinces as $key => $value)
													<option value="{{ $d506['epidem_report']['epidem_chw_code'] }}" {{ ($d506['epidem_report']['epidem_chw_code'] == $key) ? 'selected' : '' }}>{{ $value }}</option>
												@endforeach
											</select>
											@error('epidem_chw_code')<div><span class="text-danger">{{ $message }}</span></div>@enderror
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">อำเภอ (ขณะสำรวจว่าเป็นโรค)</label>
											<select name="epidem_amp_code" class="form-control form-control-lg selectpicker show-tick" data-live-search="true" data-size="6">
												<option value="">-- โปรดเลือก --</option>
												@foreach ($epidem_districts as $key => $value)
													<option value="{{ $value['district_id_2_digit'] }}" {{ ($d506['epidem_report']['epidem_amp_code'] == $value['district_id_2_digit']) ? 'selected' : '' }}>{{ $value['district_name'] }}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">ตำบล (ขณะสำรวจว่าเป็นโรค)</label>
											<select name="epidem_tmb_code" class="form-control form-control-lg selectpicker show-tick" data-live-search="true" data-size="6">
												<option value="">-- โปรดเลือก --</option>
												@foreach ($epidem_sub_districts as $key => $value)
													<option value="{{ $value['sub_district_id_2_digit'] }}" {{ ($d506['epidem_report']['epidem_tmb_code'] == $value['sub_district_id_2_digit']) ? 'selected' : '' }}>{{ $value['sub_district_name'] }}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">Latitude ที่พบโรค</label>
											<input type="text" name="location_gis_latitude" value="{{ $d506['epidem_report']['location_gis_latitude'] }}" class="form-control form-control-lg" />
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">Longitude ที่พบโรค</label>
											<input type="text" name="location_gis_longitude" value="{{ $d506['epidem_report']['location_gis_longitude'] }}" class="form-control form-control-lg" />
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">จังหวัดที่ Isolate<span class="text-danger">*</span></label>
											<select name="isolate_chw_code" class="form-control form-control-lg selectpicker show-tick" data-live-search="true" data-size="6">
												<option value="">-- โปรดเลือก --</option>
												@foreach ($provinces as $key => $value)
													<option value="{{ $d506['epidem_report']['isolate_chw_code'] }}" {{ ($d506['epidem_report']['isolate_chw_code'] == $key) ? 'selected' : '' }}>{{ $value }}</option>
												@endforeach
											</select>
											@error('isolate_chw_code')<div><span class="text-danger">{{ $message }}</span></div>@enderror
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">ประเภทผู้ป่วย<span class="text-danger">*</span></label>
											<select name="patient_type" class="form-control form-control-lg selectpicker show-tick" data-live-search="true" data-size="6">
												<option value="">-- โปรดเลือก --</option>
												@foreach ($patient_type as $key => $value)
													<option value="{{ $d506['epidem_report']['patient_type'] }}" {{ ($d506['epidem_report']['patient_type'] == $key) ? 'selected' : '' }}>{{ $value }}</option>
												@endforeach
											</select>
											@error('patient_type')<div><span class="text-danger">{{ $message }}</span></div>@enderror
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">บันทึกค้นหาในชุมชน ค้นหาผู้ป่วยเชิงรุก </label>
											<input type="text" name="active_case_finding" value="{{ $d506['epidem_report']['active_case_finding'] }}" class="form-control form-control-lg" />
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">รหัสของกลุ่ม Cluster <abbr title="อ้างอิงตาราง epidem_cluster"><i class="fa fa-info-circle"></i></abbr></label>
											<input type="text" name="epidem_cluster_type_id" value="{{ $d506['epidem_report']['epidem_cluster_type_id'] }}" class="form-control form-control-lg" />
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">Latitude ของ Cluster <abbr title="ได้จากการส่ง epidem_cluster_type_id"><i class="fa fa-info-circle"></i></abbr></label>
											<input type="text" name="cluster_latitude" value="{{ $d506['epidem_report']['cluster_latitude'] }}" class="form-control form-control-lg" />
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">Longitude ของ Cluster <abbr title="ได้จากการส่ง epidem_cluster_type_id"><i class="fa fa-info-circle"></i></abbr></label>
											<input type="text" name="cluster_longitude" value="{{ $d506['epidem_report']['cluster_longitude'] }}" class="form-control form-control-lg" />
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">คำอธิบายเพิ่มเติม</label>
											<input type="text" name="comment" value="{{ $d506['epidem_report']['comment'] }}" class="form-control form-control-lg" />
										</div>
									</div>
								</div>
							</div>

							<div class="card" style="border:1px solid #ec99ac;">
								<div class="card-header">
									<h5 class="card-title" style="font-family:Prompt;font-weight:400;color:#D45D79">3. ข้อมูลการรายงานผล LAB</h5>
								</div>
								<div class="card-block">
									<div class="row">
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">วันที่เก็บตัวอย่าง</label>
											<div class="input-group date bs-datepicker">
												<input type="text" name="specimen_date" value="{{ $d506['lab_report']['specimen_date'] }}" class="form-control form-control-lg" />
												<div class="input-group-addon input-group-append">
													<div class="input-group-text"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></div>
												</div>
											</div>
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">ผลการตรวจที่ยืนยันการติดเชื้อ <abbr title="อ้างอิงจากตาราง epidem_lab_confirm_type"><i class="fa fa-info-circle"></i></abbr></label>
											<input type="text" name="epidem_lab_confirm_type_id" value="{{ $d506['lab_report']['epidem_lab_confirm_type_id'] }}" class="form-control form-control-lg" />
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">รหัสสถานที่เก็บตัวอย่าง <abbr title="อ้างอิงจากตาราง epidem_specimen_place"><i class="fa fa-info-circle"></i></abbr></label>
											<input type="text" name="specimen_place_id" value="{{ $d506['lab_report']['specimen_place_id'] }}" class="form-control form-control-lg" />
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">วันที่รายงานผล LAB</label>
											<div class="input-group date bs-datepicker">
												<input type="text" name="lab_report_date" value="{{ $d506['lab_report']['lab_report_date'] }}" class="form-control form-control-lg" />
												<div class="input-group-addon input-group-append">
													<div class="input-group-text"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></div>
												</div>
											</div>
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">ผล LAB</label>
											<select name="lab_report_result" class="form-control form-control-lg selectpicker show-tick" data-live-search="true" data-size="6">
												<option value="">-- โปรดเลือก --</option>
												@foreach ($lab_result as $key => $value)
													<option value="{{ $d506['lab_report']['lab_report_result'] }}" {{ ($d506['lab_report']['lab_report_result'] == $key) ? 'selected' : '' }}>{{ $value }}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">รหัส LAB อ้างอิงฝั่ง HIS</label>
											<input type="text" name="lab_his_ref_code" value="{{ $d506['lab_report']['lab_his_ref_code'] }}" class="form-control form-control-lg" />
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">ชื่อรายการ Lab ฝั่ง HIS</label>
											<input type="text" name="lab_his_ref_name" value="{{ $d506['lab_report']['lab_his_ref_name'] }}" class="form-control form-control-lg" />
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
											<label class="form-label">รหัส TMLT</label>
											<input type="text" name="tmlt_code" value="{{ $d506['lab_report']['tmlt_code'] }}" class="form-control form-control-lg" />
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4">
								<button type="submit" class="btn btn-danger"><i class="fa fa-save"></i> บันทึกและส่งข้อมูล</button>
								<a href="" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> ยกเลิก</a>
							</div>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@push('script')
<script type="text/javascript" src="{{ URL::asset('js/bs-select/bootstrap-select.min.js') }}"></script>
{{-- <script type="text/javascript" src="{{ URL::asset('js/bootstrap-datepicker.min.js') }}"></script> --}}
<script type="text/javascript" src="{{ URL::asset('js/moment-with-locales-2.9.0.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap-datetimepicker.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
	$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
	$('.bs-datetimepicker').datetimepicker({
		"allowInputToggle": true,
		"showClose": true,
		"showClear": true,
		"showTodayButton": true,
		"format": "YYYY-MM-DD HH:mm:ss",
		"locale": "th",
	});
	$('.bs-datepicker').datetimepicker({
		"allowInputToggle": true,
		"showClose": true,
		"showClear": true,
		"showTodayButton": true,
		"format": "YYYY-MM-DD",
		"locale": "th",
	});
});
</script>
@endpush
