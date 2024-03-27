<?php

namespace App\Http\Controllers;

use Illuminate\Http\{Request,Response};
use Illuminate\Support\Facades\{Gate,Log};
use App\Models\{D506,Hosp2Bms,D506Hosp};
use App\Services\{D506CodeService,MophToken};

class D506Controller extends Controller
{
	protected function index() {
		// $this->authorize('isAdmin');
		if (Gate::allows('isStaff')) {
			dd('staff');
		} else {
			dd('other');
		}
		// $xx = $x->getExpireDateFromMophToken('eyJhbGciOiJSUzUxMiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIzNzU5OTAwMzIyNDE4QDEwNzM1IiwiaWF0IjoxNjkwNDc0MzYyLCJleHAiOjE2OTA0ODUxNjIsImlzcyI6Ik1PUEggQWNjb3VudCBDZW50ZXIiLCJhdWQiOiJNT1BIIEFQSSIsImNsaWVudCI6eyJ1c2VyX2lkIjo1NzUwMiwidXNlcl9oYXNoIjoiMjlGMEQzRTY0ODlFM0ZCMkFGNDlBQzZCMkUxOUUyMTE3RTQ1OEVGNEVFRUQyMEJFNDRDMTNEMTgzREUxRTAwRDhBQ0ZGM0EyMTYiLCJsb2dpbiI6IjM3NTk5MDAzMjI0MTgiLCJuYW1lIjoi4LiZ4Liy4LiH4Lib4Lin4Li14LiT4LiyIOC5gOC4l-C4teC4ouC4meC4l-C4seC4muC4l-C4tOC4oSIsImhvc3BpdGFsX25hbWUiOiLguYLguKPguIfguJ7guKLguLLguJrguLLguKXguKrguKHguYDguJTguYfguIjguJ7guKPguLDguJ7guLjguJfguJjguYDguKXguLTguKjguKvguKXguYnguLIiLCJob3NwaXRhbF9jb2RlIjoiMTA3MzUiLCJlbWFpbCI6InBhd2VlLXN1cEBob3RtYWlsLmNvbSIsImFjY291bnRfYWN0aXZhdGVkIjp0cnVlLCJhY2NvdW50X3N1c3BlbmRlZCI6ZmFsc2UsImxhc3RfY2hhbmdlX3Bhc3N3b3JkIjoxNjkwMjEwOTU1LCJsYXN0X2NvbmZpcm1fb3RwIjoxNjkwMjEwOTE0LCJjaWRfaGFzaCI6IkRENUI4NkFCREJFNTI1QzA0RjNENDAwMEI2QUJENEYwOjM4IiwiY2lkX2VuY3J5cHQiOiI0ODY0OEI1NjJENjU2NkFCRTlGQTUyMjlFRDY1MDRFMTI2NzQ5N0RBODlBNTdBQzYyRjg3RTM0MjNGMjU2REE1ODM2QzBCQzJGQUIwQURFNEFGQkFFN0Q0RjIiLCJjaWRfYWVzIjoialk2SXRZTDVpblBBalJPVmp6eTd3UT09IiwiY2xpZW50X2lwIjoiMjAzLjE1Ni4xNS4yNTIiLCJzY29wZSI6W3siY29kZSI6IklNTVVOSVpBVElPTl9FUElERU06MSJ9LHsiY29kZSI6IkVQSURFTV9VUERBVEVEQVRBOjEifSx7ImNvZGUiOiJFUElERU1fUkVQT1JUOjEifSx7ImNvZGUiOiJJTU1VTklaQVRJT05fVVBEQVRFOjEifSx7ImNvZGUiOiJJTU1VTklaQVRJT05fUEVSU09OX1VQTE9BRDoxIn0seyJjb2RlIjoiSU1NVU5JWkFUSU9OX0RBU0hCT0FSRDoxIn0seyJjb2RlIjoiSU1NVU5JWkFUSU9OX1JFUE9SVF9FWENFTDoxIn0seyJjb2RlIjoiSU1NVU5JWkFUSU9OX0xBQjoxIn1dLCJyb2xlIjpbIm1vcGgtYXBpIl0sInNjb3BlX2xpc3QiOiJbSU1NVU5JWkFUSU9OX0VQSURFTToxXVtFUElERU1fVVBEQVRFREFUQToxXVtFUElERU1fUkVQT1JUOjFdW0lNTVVOSVpBVElPTl9VUERBVEU6MV1bSU1NVU5JWkFUSU9OX1BFUlNPTl9VUExPQUQ6MV1bSU1NVU5JWkFUSU9OX0RBU0hCT0FSRDoxXVtJTU1VTklaQVRJT05fUkVQT1JUX0VYQ0VMOjFdW0lNTVVOSVpBVElPTl9MQUI6MV0iLCJhY2Nlc3NfY29kZV9sZXZlbDEiOiInMTA3MzUnIiwiYWNjZXNzX2NvZGVfbGV2ZWwyIjoiJyciLCJhY2Nlc3NfY29kZV9sZXZlbDMiOiInJyIsImFjY2Vzc19jb2RlX2xldmVsNCI6IicnIiwiYWNjZXNzX2NvZGVfbGV2ZWw1IjoiJycifX0.DaroJQV47Shbx-f0WyiSiJ-nS3NxSBcfAAHjh2AzVYOwhhLyZMx7GRgqYEycOFsaxN0QykINCfB3gUxhAjQGUodiqYdk8UbOVpvo6Aem_fXDNt318hLGf4Ud99JahQkxs-8m8CTOUpUQmMjbcDERsr53jzC7s1xLZ9Jb-YTmqKcA0uqDT7EAhppP3IFnOM4ZODgmtDldyqXOgXuweALCcogUrV2Gq4ntukHvA7ZNikxjP5vrqV7eAZn30eUIt2RnqCTHTBkWWIidEX7Lt4F8g0CP-XKbOYH5hFC7xyvcWZNs4jx7nNqRc-cs-5_YpMuLbZovUl8w50Fyhzk_VMaqVbKYVcd-4RtLFlHHR28blA-RnCHA2sXIo0ulBSAKNKFMmbOr_Cz4qjNNekjjXaYewJn32GZSOgYmKUtrxjuCPm1pdVXnfc5wGkXFpIvPKDiykwVzA85CV3x_APXTe8N7lreqfKHz20JmMVHRL9EYJmC9WReXMG-wb075jIXD0-ivrOYgcT_gGslWtZ2yykQ5_-W_VtPKV4fj6mATUz1woO1LH7MIdfK1fUmjZKolYmYZvKr0LAQ1kYb0tgUbptg5ryvL7FXwaNI8WPzXopLEk2JbwUEFnOSLHoCp8HycontwI-4d4qyCR8ptC1TB747ZJr8EijxOkQPfxwlfk0K4ch8');
		// dd($xx);

		// $data = D506::select('data')->get()->toArray();
		// foreach ($data as $key => $value) {
		// 	$item = json_decode($value['data']);
		// 	$d506 = new D506F;
		// 	$d506->hospital_code = "10735";
		// 	$d506->hospital_name = "โรงพยาบาลสมเด็จพระพุทธเลิศหล้า";
		// 	$d506->his_identifier = "HOMEC";

		// 	$d506->cid = $item->person->cid ?? "";
		// 	$d506->passport_no = $item->person->passport_no ?? "";
		// 	$d506->prefix = $item->person->prefix ?? "";
		// 	$d506->first_name = $item->person->first_name ?? "";
		// 	$d506->last_name = $item->person->last_name ?? "";
		// 	$d506->nationality = $item->person->nationality ?? "";
		// 	$d506->gender = $item->person->gender ?? "";
		// 	$d506->birth_date = $item->person->birthDate ?? '0000-00-00';
		// 	$d506->age_y = $item->person->age_y ?? 0;
		// 	$d506->age_m = $item->person->age_m ?? 0;
		// 	$d506->age_d = $item->person->age_d ?? 0;
		// 	$d506->marital_status_id = $item->person->marital_status_id ?? "";
		// 	$d506->address = $item->person->address ?? "";
		// 	$d506->moo = $item->person->moo ?? "";
		// 	$d506->road = $item->person->road ?? "";
		// 	$d506->chw_code = $item->person->chw_code ?? "75";
		// 	$d506->amp_code = $item->person->amp_code ?? "01";
		// 	$d506->tmb_code = $item->person->tmb_code ?? "02";
		// 	$d506->mobile_phone = $item->person->mobile_phone ?? "";
		// 	$d506->occupation = $item->person->occupation ?? "";

		// 	$d506->epidem_report_guid = $item->epidem_report->epidem_report_guid ?? '{}';
		// 	$d506->epidem_report_group_code = $item->epidem_report->epidem_report_group_id ?? "";
		// 	$d506->treated_hospital_code = $item->epidem_report->treated_hospital_code ?? "";
		// 	$d506->report_datetime = $item->epidem_report->report_datetime ?? "";
		// 	$d506->onset_date = $item->epidem_report->onset_date ?? "";
		// 	$d506->treated_date = $item->epidem_report->treated_date ?? "";
		// 	$d506->diagnosis_date = $item->epidem_report->diagnosis_date ?? "";
		// 	$d506->death_date = $item->epidem_report->death_date ?? "";
		// 	$d506->cdeath = $item->epidem_report->cdeath ??  "";
		// 	$d506->informer_name = $item->epidem_report->informer_name ?? "";
		// 	$d506->organism = $item->epidem_report->organism ?? "";
		// 	$d506->complication = $item->epidem_report->complication ?? "";
		// 	$d506->diagnosis_icd10 = $item->epidem_report->diagnosis_icd10 ?? "";
		// 	$d506->diagnosis_icd10_list = $item->epidem_report->diagnosis_icd10 ?? "";
		// 	$d506->epidem_person_status_id = $item->epidem_report->epidem_person_status_id ?? "";
		// 	$d506->epidem_symptom_type_id = $item->epidem_report->epidem_symptom_type_id ?? "";
		// 	$d506->municipal = $item->epidem_report->municipal ?? 3; // df 3
		// 	$d506->respirator_status = $item->epidem_report->respirator_status ?? "N"; // df N
		// 	$d506->vaccinated_status = $item->epidem_report->vaccinated_status ?? "N"; // df N
		// 	$d506->epidem_address = $item->epidem_report->epidem_address ?? "";
		// 	$d506->epidem_moo = $item->epidem_report->epidem_moo ?? "";
		// 	$d506->epidem_road = $item->epidem_report->epidem_road ?? "";
		// 	$d506->epidem_chw_code = $item->epidem_report->epidem_chw_code ?? "75"; // df 75
		// 	$d506->epidem_amp_code = $item->epidem_report->epidem_amp_code ?? "01"; // df 01
		// 	$d506->epidem_tmb_code = $item->epidem_report->epidem_tmb_code ?? "01"; // df 01
		// 	$d506->location_gis_latitude = $item->epidem_report->location_gis_latitude ?? "";
		// 	$d506->location_gis_longitude = $item->epidem_report->location_gis_longitude ?? "";
		// 	$d506->isolate_chw_code = $item->epidem_report->isolate_chw_code ?? "75"; // df 75
		// 	$d506->patient_type = $item->epidem_report->patient_type ?? "";
		// 	$d506->active_case_finding = $item->epidem_report->active_case_finding ?? "";
		// 	$d506->epidem_cluster_type_id = $item->epidem_report->epidem_cluster_type_id ?? "";
		// 	$d506->cluster_latitude = $item->epidem_report->cluster_latitude ?? "";
		// 	$d506->cluster_longitude = $item->epidem_report->cluster_longitude ?? "";
		// 	$d506->comment = $item->epidem_report->comment ?? "";

		// 	$d506->specimen_date = $item->lab_report->specimen_date ?? "";
		// 	$d506->epidem_lab_confirm_type_id = $item->lab_report->epidem_lab_confirm_type_id ?? "";
		// 	$d506->specimen_place_id =  $item->lab_report->specimen_place_id ?? "";
		// 	$d506->lab_report_date = $item->lab_report->lab_report_date ?? "";
		// 	$d506->lab_report_result = $item->lab_report->lab_report_result ?? "";
		// 	$d506->lab_his_ref_code = $item->lab_report->lab_his_ref_code ?? "";
		// 	$d506->lab_his_ref_name = $item->lab_report->lab_his_ref_name ?? "";
		// 	$d506->tmlt_code = $item->lab_report->tmlt_code ?? "";

		// 	$d506->vaccine_hospital_code =  $item->vaccination[0]->vaccine_hospital_code ?? "";
		// 	$d506->vaccine_date = $item->vaccination[0]->vaccine_date ?? "";
		// 	$d506->dose = $item->vaccination[0]->dose ?? "";
		// 	$d506->vaccine_manufacturer = $item->vaccination[0]->vaccine_manufacturer ?? "";
		// 	$d506->save();
		// }
	}

	protected function create(): Response {
		try {
			// Hosp2Bms::chunk(10, function($data) {
			// 	foreach ($data as $item) {
			// 		$d506 = new D506;
			// 		$d506->hospital_code = "10735";
			// 		$d506->hospital_name = "โรงพยาบาลสมเด็จพระพุทธเลิศหล้า";
			// 		$d506->his_identifier = "HOMEC";

			// 		$d506->cid = trim($item->cid) ?? "";
			// 		$d506->passport_no = $item->passport_no ?? "";
			// 		$d506->prefix = $item->prefix ?? "";
			// 		$d506->first_name = $item->first_name ?? "";
			// 		$d506->last_name = $item->last_name ?? "";
			// 		$d506->nationality = $item->nationality ?? "";
			// 		$d506->gender = $item->gender ?? "";
			// 		$d506->birth_date = $item->birthDate ?? '0000-00-00';
			// 		$d506->age_y = $item->age_y ?? 0;
			// 		$d506->age_m = $item->age_m ?? 0;
			// 		$d506->age_d = $item->age_d ?? 0;
			// 		$d506->marital_status_id = $item->marital_status_id ?? "";
			// 		$d506->address = $item->address ?? "";
			// 		$d506->moo = $item->moo ?? "";
			// 		$d506->road = $item->road ?? "";
			// 		$d506->chw_code = $item->chw_code ?? "75";
			// 		$d506->amp_code = $item->amp_code ?? "01";
			// 		$d506->tmb_code = $item->tmb_code ?? "02";
			// 		$d506->mobile_phone = (isset($item->mobile_phone) || !empty($item->mobile_phone)) ? $item->mobile_phone : "";
			// 		$d506->occupation = trim($item->occupation) ?? "";

			// 		$d506->epidem_report_guid = '{'.$item->epidem_report_guid.'}' ?? '{}';
			// 		$d506->epidem_report_group_code = $item->epidem_report_group_id ?? "";
			// 		$d506->treated_hospital_code = $item->treated_hospital_code ?? "";
			// 		$d506->report_datetime = date('Y-m-d').'T'.date('H:i:s').'.000'; //2023-07-05T13:01:05.000'
			// 		$d506->onset_date = $item->onset_date ?? "";
			// 		$d506->treated_date = $item->treated_date ?? "";
			// 		$d506->diagnosis_date = $item->diagnosis_date ?? "";
			// 		$d506->death_date = $item->death_date ?? "";
			// 		$d506->cdeath = (isset($item->cdeath) || !empty($item->cdeath)) ? $item->cdeath : "";
			// 		$d506->informer_name = (isset($item->informer_name) || !empty($item->informer_name)) ? $item->informer_name : "";
			// 		$d506->organism = (isset($item->organism) || !empty($item->organism)) ? $item->organism : "";
			// 		$d506->complication = (isset($item->complication) || !empty($item->complication)) ? $item->complication : "";
			// 		$d506->diagnosis_icd10 = $item->diagnosis_icd10 ?? "";
			// 		$d506->diagnosis_icd10_list = $item->diagnosis_icd10 ?? "";
			// 		$d506->epidem_person_status_id = $item->epidem_person_status_id ?? "";
			// 		$d506->epidem_symptom_type_id = $item->epidem_symptom_type_id ?? "";
			// 		$d506->municipal = $item->municipal ?? 3; // df 3
			// 		$d506->respirator_status = $item->respirator_status ?? "N"; // df N
			// 		$d506->vaccinated_status = $item->vaccinated_status ?? "N"; // df N
			// 		$d506->epidem_address = $item->epidem_address ?? "";
			// 		$d506->epidem_moo = $item->epidem_moo ?? "";
			// 		$d506->epidem_road = $item->epidem_road ?? "";
			// 		$d506->epidem_chw_code = $item->epidem_chw_code ?? "75"; // df 75
			// 		$d506->epidem_amp_code = $item->epidem_amp_code ?? "01"; // df 01
			// 		$d506->epidem_tmb_code = $item->epidem_tmb_code ?? "01"; // df 01
			// 		$d506->location_gis_latitude = (isset($item->location_gis_latitude) || !empty($item->location_gis_latitude)) ? $item->location_gis_latitude : "";
			// 		$d506->location_gis_longitude = (isset($item->location_gis_longitude) || !empty($item->location_gis_longitude)) ? $item->location_gis_longitude : "";
			// 		$d506->isolate_chw_code = $item->isolate_chw_code ?? "75"; // df 75
			// 		$d506->patient_type = $item->patient_type ?? "";
			// 		$d506->active_case_finding = (isset($item->active_case_finding) || !empty($item->active_case_finding)) ? $item->active_case_finding : "";
			// 		$d506->epidem_cluster_type_id = (isset($item->epidem_cluster_type_id) || !empty($item->epidem_cluster_type_id)) ? $item->epidem_cluster_type_id : "";
			// 		$d506->cluster_latitude = (isset($item->cluster_latitude) || !empty($item->cluster_latitude)) ? $item->cluster_latitude : "";
			// 		$d506->cluster_longitude = (isset($item->cluster_longitude) || !empty($item->cluster_longitude)) ? $item->cluster_longitude : "";
			// 		$d506->comment = (isset($item->comment) || !empty($item->comment)) ? trim($item->comment) : "";

			// 		$d506->specimen_date = (isset($item->specimen_date) || !empty($item->specimen_date)) ? $item->specimen_date : "";
			// 		$d506->epidem_lab_confirm_type_id = (isset($item->epidem_lab_confirm_type_id) || !empty($item->epidem_lab_confirm_type_id)) ? $item->epidem_lab_confirm_type_id : "";
			// 		$d506->specimen_place_id =  (isset($item->specimen_place_id) || !empty($item->specimen_place_id)) ? $item->specimen_place_id : "";
			// 		$d506->lab_report_date = (isset($item->lab_report_date) || !empty($item->lab_report_date)) ? : "";
			// 		$d506->lab_report_result = (isset($item->lab_report_result) || !empty($item->lab_report_result)) ? $item->lab_report_result : "";
			// 		$d506->lab_his_ref_code = (isset($item->lab_his_ref_code) || !empty($item->lab_his_ref_code)) ? $item->lab_his_ref_code : "";
			// 		$d506->lab_his_ref_name = (isset($item->lab_his_ref_name) || !empty($item->lab_his_ref_name)) ? $item->lab_his_ref_name : "";
			// 		$d506->tmlt_code = (isset($item->tmlt_code) || !empty($item->tmlt_code)) ? $item->tmlt_code : "";

			// 		$d506->vaccine_hospital_code =  (isset($item->vaccine_hospital_code) || !empty($item->vaccine_hospital_code)) ? $item->vaccine_hospital_code : "";
			// 		$d506->vaccine_date = (isset($item->vaccine_date) || !empty($item->vaccine_date)) ? $item->vaccine_date : "";
			// 		$d506->dose = (isset($item->dose) || !empty($item->dose)) ? $item->dose : "";
			// 		$d506->vaccine_manufacturer = (isset($item->vaccine_manufacturer) || !empty($item->vaccine_manufacturer)) ? $item->vaccine_manufacturer : "";
			// 		$d506->save();
			// 		$d506->delete();
			// 	}
			// });
			return response()->noContent();
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}


	public function store() {

	}

	public function show(string $id) {
		//
	}

	public function edit(string $id) {
		//
	}

	public function update(Request $request, string $id) {
		//
	}

	public function destroy(string $id) {
		//
	}

	// public function getData() {
	//     D506::select('id', 'data', 'created_at')->whereDate('created_at', date('Y-m-d'))->chunk(100, function($result) {
	//         foreach ($result as $key => $val) {
	// 		$data = preg_replace(pattern: "/\r|\n|\t/", replacement: "", subject: $val->data);
	// 		$data = json_decode(json: $data, associative: true);
	//         dd($data);
	//         }
	//     });
	//     dd('y');
	// }
}
