<?php

namespace App\Services;

use App\Interfaces\PrepareData;
use App\Services\D506CodeService;
use Illuminate\Support\Facades\Log;

class D506Prepare implements PrepareData
{
	private $d505_service;

	public function __construct(D506CodeService $d506_service) {
		$this->d505_service = $d506_service;
	}

	public function convStringToUtf8(string $string): string {
		return iconv(mb_detect_encoding(string: $string, encodings: mb_detect_order(), strict: true), 'UTF-8', $string);
	}

	public function convertDateTime($iso_8601_date_time): string {
		$convert = date("c", strtotime($iso_8601_date_time));
		$explode = explode("+", $convert);
		$result = $explode[0].".000";
		return $result;
	}

	public function setDataToJson(object $item): ?string {
		try {
			$hospital['hospital_code'] = env('HOSP_CODE'); //"10735";
			$hospital['hospital_name'] = $this->convStringToUtf8(string: env('HOSP_NAME')); //"โรงพยาบาลสมเด็จพระพุทธเลิศหล้า";
			$hospital['his_identifier'] = env('HOSP_HIS'); //"HOMEC";

			$person['cid'] = trim($item->cid, " \n\r\t\v\x00") ?? ""; // not null
			$person['passport_no'] = (!empty($item->passport_no)) ? (string)$item->passport_no : "";
			$person['prefix'] = (!empty($item->prefix)) ? $item->prefix : ""; //
			$person['first_name'] = (!empty($item->first_name)) ? trim($item->first_name) : "";
			$person['last_name'] = (!empty($item->last_name)) ? trim($item->last_name) : "";
			$person['nationality'] = (string)$item->nationality ?? "";
			$person['gender'] = (int)$item->gender ?? ""; //
			$person['birth_date'] = (!empty($item->birthDate)) ? $item->birthDate : ""; //
			$person['age_y'] = (!empty($item->age_y)) ? (int)$item->age_y : ""; //
			$person['age_m'] = (!empty($item->age_m)) ? (int)$item->age_m : ""; //
			$person['age_d'] = (!empty($item->age_d)) ? (int)$item->age_d : ""; //
			$person['marital_status_id'] = (int)$item->marital_status_id ?? "";
			$person['address'] = (string)$item->address ?? ""; //
			$person['moo'] = (string)$item->moo ?? "";
			$person['road'] = (!empty($item->road)) ? (string)$item->road : "";
			$person['chw_code'] = (string)$item->chw_code ?? "75"; //
			$person['amp_code'] = (string)$item->amp_code ?? "01"; //
			$person['tmb_code'] = (string)$item->tmb_code ?? "02"; //
			$person['mobile_phone'] = (string)$item->mobile_phone ?? "";
			$person['occupation'] = (!empty($item->occupation)) ? trim($item->occupation) : "";

			$epidem_report['epidem_report_guid'] = "{".$item->epidem_report_guid."}" ?? ""; //
			$epidem_report['epidem_report_group_code'] = (!empty($item->epidem_report_group_code))
				? trim($item->epidem_report_group_code, " \n\r\t\v\x00")
				: $this->d505_service->code506(trim($item->diagnosis_icd10, " \n\r\t\v\x00"))->get();

			$epidem_report['treated_hospital_code'] = env('HOSP_CODE'); //"10375"; //
			$epidem_report['report_datetime'] = date('Y-m-d').'T'.date('H:i:s').'.000'; //
			$epidem_report['onset_date'] = $item->onset_date ?? "";
			$epidem_report['treated_date'] = $item->treated_date ?? "";
			$epidem_report['diagnosis_date'] = $item->diagnosis_date ?? "";
			$epidem_report['death_date'] = $item->death_date ?? "";
			$epidem_report['cdeath'] = (string)$item->cdeath ?? "";
			$epidem_report['informer_name'] = (string)$item->informer_name ?? "";
			$epidem_report['organism'] = $item->organism ?? 2;
			$epidem_report['complication'] = $item->complication ?? 10;
			// $epidem_report['diagnosis_icd10'] = (!empty($item->diagnosis_icd10)) ? (string)trim($item->diagnosis_icd10) : ""; //
			$epidem_report['principal_diagnosis_icd10'] = (!empty($item->diagnosis_icd10)) ? $item->diagnosis_icd10 : ""; //
			$epidem_report['diagnosis_icd10_list'] = (!empty($item->diagnosis_icd10_list)) ? $item->diagnosis_icd10_list : $item->diagnosis_icd10; //
			$epidem_report['epidem_person_status_id'] = (!empty($item->epidem_person_status_id)) ? (int)$item->epidem_person_status_id : 4; //
			$epidem_report['epidem_symptom_type_id'] = (int)$item->epidem_symptom_type_id ?? 2; //
			$epidem_report['municipal'] = (!empty($item->municipal)) ? (int)$item->municipal : 3; // default 3
			$epidem_report['respirator_status'] = (!empty($item->respirator_status)) ? (string)$item->respirator_status : "N"; // df N
			$epidem_report['vaccinated_status'] = (!empty($item->vaccinated_status)) ? (string)$item->vaccinated_status : "N"; // df N
			$epidem_report['epidem_address'] = (string)$item->epidem_address ?? "";
			$epidem_report['epidem_moo'] = (string)$item->epidem_moo ?? "";
			$epidem_report['epidem_road'] = (string)$item->epidem_road ?? "";
			$epidem_report['epidem_chw_code'] = (!empty($item->epidem_chw_code)) ? (string)$item->epidem_chw_code : "75"; // df 75
			$epidem_report['epidem_amp_code'] = (string)$item->epidem_amp_code ?? "01";
			$epidem_report['epidem_tmb_code'] = (string)$item->epidem_tmb_code ?? "01";
			$epidem_report['location_gis_latitude'] = $item->location_gis_latitude ?? "";
			$epidem_report['location_gis_longitude'] = $item->location_gis_longitude ?? "";
			$epidem_report['isolate_chw_code'] = (!empty($item->isolate_chw_code)) ? (string)$item->isolate_chw_code : "75"; // df 75
			$epidem_report['patient_type'] = (!empty($item->patient_type)) ? $item->patient_type : "OPD"; //
			$epidem_report['active_case_finding'] = (string)$item->active_case_finding ?? "";
			$epidem_report['epidem_cluster_type_id'] = (int)$item->epidem_cluster_type_id ?? 1;
			$epidem_report['cluster_latitude'] = $item->cluster_latitude ?? "";
			$epidem_report['cluster_longitude'] = $item->cluster_longitude ?? "";
			$epidem_report['comment'] = (string)$item->comment ?? "";

			$lab_report['specimen_date'] = $item->specimen_date ?? "";
			$lab_report['epidem_lab_confirm_type_id'] = $item->epidem_lab_confirm_type_id ?? 1;
			$lab_report['specimen_place_id'] =  $item->specimen_place_id ?? 2;
			$lab_report['lab_report_date'] = $item->lab_report_date ?? "";
			$lab_report['lab_report_result'] = $item->lab_report_result ?? "";
			$lab_report['lab_his_ref_code'] = $item->lab_his_ref_code ?? "";
			$lab_report['lab_his_ref_name'] = $item->lab_his_ref_name ?? "";
			$lab_report['tmlt_code'] = $item->tmlt_code ?? "";

			$vaccination['vaccine_hospital_code'] =  $item->vaccine_hospital_code ?? "";
			$vaccination['vaccine_date'] = $item->vaccine_date ?? "";
			$vaccination['dose'] = (int)$item->dose ?? 1;
			$vaccination['vaccine_manufacturer'] = $item->vaccine_manufacturer ?? "";

			$json_format = [
				'hospital' => $hospital,
				'person' => $person,
				'epidem_report' => $epidem_report,
				'lab_report' => $lab_report,
				'vaccination' => [$vaccination],
			];

			$json = json_encode(value: $json_format, flags: JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
			return $json;
		} catch (\Exception $e) {
			Log::error('Set data to json failed: '.$e->getMessage());
			return null;
		}
	}

	public function setDataToJsonFromRequest(array $item): ?string {
		try {
			$hospital['hospital_code'] = $item['hospital_code'];
			$hospital['hospital_name'] = $item['hospital_name'];
			$hospital['his_identifier'] = $item['his_identifier'];

			$person['cid'] = trim($item['cid'], " \n\r\t\v\x00") ?? "";
			$person['passport_no'] = (!empty($item['passport_no'])) ? (string)$item['passport_no'] : "";
			$person['prefix'] = $item['prefix'];
			$person['first_name'] = trim($item['first_name']);
			$person['last_name'] = trim($item['last_name']);
			$person['nationality'] = (string)$item['nationality'];
			$person['gender'] = (string)$item['gender'];
			$person['birth_date'] = $item['birth_date'];
			$person['age_y'] = (!empty($item['age_y'])) ? (int)$item['age_y'] : "";
			$person['age_m'] = (!empty($item['age_m'])) ? (int)$item['age_m'] : "";
			$person['age_d'] = (!empty($item['age_d'])) ? (int)$item['age_d'] : "";
			$person['marital_status_id'] = (int)$item['marital_status_id'];
			$person['address'] = (string)$item['address'];
			$person['moo'] = (string)$item['moo'];
			$person['road'] = (string)$item['road'];
			$person['chw_code'] = (string)$item['chw_code'];
			$person['amp_code'] = (string)$item['amp_code'];
			$person['tmb_code'] = (string)$item['tmb_code'];
			$person['mobile_phone'] = (string)$item['mobile_phone'];
			$person['occupation'] = $item['occupation'];

			$epidem_report['epidem_report_guid'] = (!empty($item['epidem_report_guid'])) ? "{".$item['epidem_report_guid']."}" : "";
			$epidem_report['epidem_report_group_code'] = $item['epidem_report_group_code'];

			$epidem_report['treated_hospital_code'] = $item['treated_hospital_code'];
			$epidem_report['report_datetime'] = (!empty($item['report_datetime'])) ? $this->convertDateTime($item['report_datetime']) : "";
			$epidem_report['onset_date'] = $item['onset_date'];
			$epidem_report['treated_date'] = $item['treated_date'];
			$epidem_report['diagnosis_date'] = $item['diagnosis_date'];
			$epidem_report['death_date'] = $item['death_date'];
			$epidem_report['cdeath'] = $item['cdeath'];
			$epidem_report['informer_name'] = $item['informer_name'];
			$epidem_report['organism'] = $item['organism'];
			$epidem_report['complication'] = $item['complication'];
			$epidem_report['principal_diagnosis_icd10'] = $item['principal_diagnosis_icd10'];
			$epidem_report['diagnosis_icd10_list'] = $item['diagnosis_icd10_list'];
			$epidem_report['epidem_person_status_id'] = $item['epidem_person_status_id'];
			$epidem_report['epidem_symptom_type_id'] = $item['epidem_symptom_type_id'];
			$epidem_report['municipal'] = $item['municipal'];
			$epidem_report['respirator_status'] = (!empty($item['respirator_status'])) ? $item['respirator_status'] : "N"; // df N
			$epidem_report['vaccinated_status'] = $item['vaccinated_status'];
			$epidem_report['epidem_address'] = $item['epidem_address'];
			$epidem_report['epidem_moo'] = $item['epidem_moo'];
			$epidem_report['epidem_road'] = $item['epidem_road'];
			$epidem_report['epidem_chw_code'] = $item['epidem_chw_code'];
			$epidem_report['epidem_amp_code'] = $item['epidem_amp_code'];
			$epidem_report['epidem_tmb_code'] = $item['epidem_tmb_code'];
			$epidem_report['location_gis_latitude'] = $item['location_gis_latitude'];
			$epidem_report['location_gis_longitude'] = $item['location_gis_longitude'];
			$epidem_report['isolate_chw_code'] = $item['isolate_chw_code'];
			$epidem_report['patient_type'] = $item['patient_type'];
			$epidem_report['active_case_finding'] = $item['active_case_finding'];
			$epidem_report['epidem_cluster_type_id'] = $item['epidem_cluster_type_id'];
			$epidem_report['cluster_latitude'] = $item['cluster_latitude'];
			$epidem_report['cluster_longitude'] = $item['cluster_longitude'];
			$epidem_report['comment'] = trim($item['comment']);

			$lab_report['specimen_date'] = $item['specimen_date'];
			$lab_report['epidem_lab_confirm_type_id'] = $item['epidem_lab_confirm_type_id'];
			$lab_report['specimen_place_id'] =  $item['specimen_place_id'];
			$lab_report['lab_report_date'] = $item['lab_report_date'];
			$lab_report['lab_report_result'] = $item['lab_report_result'];
			$lab_report['lab_his_ref_code'] = $item['lab_his_ref_code'];
			$lab_report['lab_his_ref_name'] = $item['lab_his_ref_name'];
			$lab_report['tmlt_code'] = $item['tmlt_code'];

			$vaccination['vaccine_hospital_code'] =  "";
			$vaccination['vaccine_date'] = "";
			$vaccination['dose'] = "";
			$vaccination['vaccine_manufacturer'] = "";

			$json_format = [
				'hospital' => $hospital,
				'person' => $person,
				'epidem_report' => $epidem_report,
				'lab_report' => $lab_report,
				'vaccination' => [$vaccination],
			];

			$json = json_encode(value: $json_format, flags: JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
			return $json;
		} catch (\Exception $e) {
			Log::error('Set data to json from request failed: '.$e->getMessage());
			return null;
		}
	}

	public function setDataToArray(object $item): ?array {
		$plain_data['cid'] = $item->cid;
		$plain_data['passport_no'] = $item->passport_no;
		$plain_data['prefix'] = $item->perfix;
		$plain_data['first_name'] = $item->first_name;
		$plain_data['last_name'] = $item->last_name;
		$plain_data['gender'] = $item->gender;
		$plain_data['epidem_report_guid'] = $item->epidem_report_guid;
		$plain_data['hn'] = $item->Hn;
		$plain_data['reg_no'] = $item->regNo;
		$plain_data['visit_date'] = $item->VisitDate;
		$plain_data['diag_date'] = $item->DiagDate;
		$plain_data['last_diag_date'] = $item->lastDiagdate;
		$plain_data['last_update'] = $item->lastupdate;
		return $plain_data;
	}

	public function setDataToArrayFromRequest(array $item): ?array {
		$plain_data['cid'] = $item['cid'];
		$plain_data['passport_no'] = $item['passport_no'];
		$plain_data['prefix'] = $item['prefix'];
		$plain_data['first_name'] = $item['first_name'];
		$plain_data['last_name'] = $item['last_name'];
		$plain_data['gender'] = $item['gender'];
		$plain_data['epidem_report_guid'] = $item['epidem_report_guid'];
		return $plain_data;
	}
}
