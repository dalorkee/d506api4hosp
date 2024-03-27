<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreD506Request extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array {
		return [
			'id' => 'required',
			'hospital_code' => 'required',
			'hospital_name' => 'required',
			'cid' => 'required',
			'prefix' => 'required',
			'first_name' => 'required',
			'last_name' => 'required',
			'gender' => 'required',
			'birth_date' => 'required',
			'age_y' => 'required',
			'age_m' => 'required',
			'age_d' => 'required',
			'address' => 'required',
			'chw_code' => 'required',
			'amp_code' => 'required',
			'tmb_code' => 'required',
			'epidem_report_guid' => 'required',
			'epidem_report_group_code' => 'required',
			'treated_hospital_code' => 'required',
			'report_datetime' => 'required',
			'principal_diagnosis_icd10' => 'required',
			'diagnosis_icd10_list' => 'required',
			'epidem_person_status_id' => 'required',
			'municipal' => 'required',
			'respirator_status' => 'required',
			'epidem_chw_code' => 'required',
			'isolate_chw_code' => 'required',
			'patient_type' => 'required',
		];
	}

	public function messages() {
		return [
			'hospital_code.required' => 'ไม่พบรหัสหน่วยบริการ',
			'hospital_name.required' => 'ไม่พบชื่อหน่วยบริการ',
			'cid.required' => 'โปรดกรอก CID',
			'prefix.required' => 'โปรดเลือก คำนำหน้าชื่อ',
			'first_name.required' => 'โปรดกรอก ชื่อ',
			'last_name.required' => 'โปรดกรอก นามสกุล',
			'gender.required' => 'โปรดเลือก เพศ',
			'birth_date.required' => 'โปรดกรอก วันเดือนปี เกิด',
			'age_y.required' => 'โปรดกรอก อายุปี',
			'age_m.required' => 'โปรดกรอก อายุเดือน',
			'age_d.required' => 'โปรดกรอก อายุวัน',
			'address.required' => 'โปรดกรอก ที่อยู่ปัจจุบัน',
			'chw_code.required' => 'โปรดเลือก จังหวัด',
			'amp_code.required' => 'โปรดเลือก อำเภอ',
			'tmb_code.required' => 'โปรดกรอก ตำบล',
			'epidem_report_guid.required' => 'ไม่พบ Epidem GUID',
			'epidem_report_group_code.required' => 'โปรดกรอก รหัสกลุ่มโรคทางระบาดวิทยา',
			'treated_hospital_code.required' => 'โปรดกรอก รหัสโรงพยาบาลที่กำลังรักษาตัว',
			'report_datetime.required' => 'โปรดกรอก วัน/เวลา ที่รายงานโรค',
			'principal_diagnosis_icd10.required' => 'โปรดกรอก รหัส ICD10 หลัก',
			'diagnosis_icd10_list.required' => 'โปรดกรอก รหัส ICD10 รอง',
			'epidem_person_status_id.required' => 'โปรดเลือก สภาพผู้ป่วย',
			'municipal.required' => 'โปรดกรอก เขตพื้นที่รักษาตัว (เทศบาล)',
			'respirator_status.required' => 'โปรดเลือก ใส่เครื่องช่วยหายใจ',
			'epidem_chw_code.required' => 'โปรดเลือก จังหวัด (ขณะสำรวจว่าเป็นโรค)',
			'isolate_chw_code.required' => 'โปรดเลือก จังหวัดที่ Isolate',
			'patient_type.required' => 'โปรดเลือก ประเภทผู้ป่วย',
		];
	}

}
