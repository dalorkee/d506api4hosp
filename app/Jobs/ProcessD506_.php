<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\{ShouldBeUnique,ShouldQueue};
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Response;
use Illuminate\Queue\{InteractsWithQueue,SerializesModels};
use Illuminate\Support\Facades\{Http,Log,DB};
use Illuminate\Support\Sleep;
use App\Models\{ApiConfig,D506,Hosp2Bms};
use Carbon\Carbon;

class ProcessD506_ implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	public $tries = 5;
	public $timeout = 120;

	protected string $hosp_code;
	protected string $hosp_name;
	protected string $hosp_user;
	protected string $hosp_password;
	protected string $token_url;
	protected string $send_506_url;
	protected string $moph_secret_key;
	protected string $token;
	protected array $data_index;

	public function __construct() {
		$this->data_index = [];
		$this->setEnvFromDb();
		$this->moph_secret_key = $this->getEnv(var: 'MOPH_SECRET');
		$this->token = $this->getToken();
	}

	public function handle() {
		try {
			if (count($this->data_index) > 0) {
				foreach ($this->data_index as $key => $value) {
					$data = $this->setDataToJson(index: $value);
				}
			}

		} catch (\Exception $e) {
			Log::error(message: $e->getMessage());
		}
	}

	protected function setDataToJson(int $index): mixed {
		try {
			$item = D506::findOr($index, fn () => throw new \Exception('Data index: '.$index.' not found'));

			$hospital['hospital_code'] = "10735";
			$hospital['hospital_name'] = "โรงพยาบาลสมเด็จพระพุทธเลิศหล้า";
			$hospital['his_identifier'] = "HOMEC";

			$person['cid'] = (string)$item->cid ?? ""; // not null
			$person['passport_no'] = (!empty($item->passport_no)) ? (string)$item->passport_no : "AD-333-th";
			$person['prefix'] = (!empty((string)$item->prefix)) ? (string)$item->prefix : "นาย"; //
			$person['first_name'] = trim((string)$item->first_name) ?? "";
			$person['last_name'] = trim((string)$item->last_name) ?? "";
			$person['nationality'] = (string)$item->nationality ?? "";
			$person['gender'] = (int)$item->gender ?? ""; //
			$person['birth_date'] = (!empty($item->birthDate)) ? $item->birthDate : '1992-01-01'; //
			$person['age_y'] = (!empty($item->age_y)) ? (int)$item->age_y : 13; //
			$person['age_m'] = (!empty($item->age_m)) ? (int)$item->age_m : 11; //
			$person['age_d'] = (!empty($item->age_d)) ? (int)$item->age_d : 3; //
			$person['marital_status_id'] = (int)$item->marital_status_id ?? 2;
			$person['address'] = (string)$item->address ?? "66"; //
			$person['moo'] = (string)$item->moo ?? "2";
			$person['road'] = (!empty($item->road)) ? (string)$item->road : "ถนน";
			$person['chw_code'] = (string)$item->chw_code ?? "75"; //
			$person['amp_code'] = (string)$item->amp_code ?? "01"; //
			$person['tmb_code'] = (string)$item->tmb_code ?? "02"; //
			$person['mobile_phone'] = (string)$item->mobile_phone ?? "086-1111111";
			$person['occupation'] = (!empty($item->occupation)) ? trim($item->occupation) : "099";
			$person['occupation'] =  "099";

			$epidem_report['epidem_report_guid'] = '{'.$item->epidem_report_guid.'}' ?? '{CF8A9DCC-FCD4-4A22-8A64-1F0A0838C277}'; //
			$epidem_report['epidem_report_group_code'] = (!empty($item->epidem_report_group_id)) ? $item->epidem_report_group_id : "22"; //
			$epidem_report['treated_hospital_code'] = "10375"; //
			$epidem_report['report_datetime'] = '2023-06-19T09:10:10.000'; //
			$epidem_report['onset_date'] = $item->onset_date ?? "2023-01-02";
			$epidem_report['treated_date'] = $item->treated_date ?? "2023-01-03";
			$epidem_report['diagnosis_date'] = $item->diagnosis_date ?? "2023-03-30";
			$epidem_report['death_date'] = $item->death_date ?? "";
			$epidem_report['cdeath'] = (string)$item->cdeath ?? "test";
			$epidem_report['informer_name'] = (string)$item->informer_name ?? "";
			$epidem_report['organism'] = $item->organism ?? 2;
			$epidem_report['complication'] = $item->complication ?? 10;
			$epidem_report['diagnosis_icd10'] = (!empty($item->diagnosis_icd10)) ? (string)trim($item->diagnosis_icd10) : "U071"; //
			$epidem_report['diagnosis_icd10_list'] = trim($item->diagnosis_icd10) ?? (string)$item->diagnosis_icd10; //
			$epidem_report['epidem_person_status_id'] = (!empty($item->epidem_person_status_id)) ? (int)$item->epidem_person_status_id : 4; //
			$epidem_report['epidem_symptom_type_id'] = (int)$item->epidem_symptom_type_id ?? 2; //
			$epidem_report['municipal'] = (!empty($item->municipal)) ? (int)$item->municipal : 3; // default 3
			$epidem_report['respirator_status'] = (!empty($item->respirator_status)) ? (string)$item->respirator_status : "N"; // df N
			$epidem_report['vaccinated_status'] = (!empty($item->vaccinated_status)) ? (string)$item->vaccinated_status : "N"; // df N
			$epidem_report['epidem_address'] = (string)$item->epidem_address ?? "11";
			$epidem_report['epidem_moo'] = (string)$item->epidem_moo ?? "1";
			$epidem_report['epidem_road'] = (string)$item->epidem_road ?? "road";
			$epidem_report['epidem_chw_code'] = (!empty($item->epidem_chw_code)) ? (string)$item->epidem_chw_code : "75"; // df 75
			$epidem_report['epidem_amp_code'] = (string)$item->epidem_amp_code ?? "01";
			$epidem_report['epidem_tmb_code'] = (string)$item->epidem_tmb_code ?? "01";
			$epidem_report['location_gis_latitude'] = $item->location_gis_latitude ?? "";
			$epidem_report['location_gis_longitude'] = $item->location_gis_longitude ?? "";
			$epidem_report['isolate_chw_code'] = (!empty($item->isolate_chw_code)) ? (string)$item->isolate_chw_code : "75"; // df 75
			$epidem_report['patient_type'] = (!empty($item->patient_type)) ? $item->patient_type : "OPD"; //
			$epidem_report['active_case_finding'] = (string)$item->active_case_finding ?? "ทดสอบ";
			$epidem_report['epidem_cluster_type_id'] = (int)$item->epidem_cluster_type_id ?? 1;
			$epidem_report['cluster_latitude'] = $item->cluster_latitude ?? "";
			$epidem_report['cluster_longitude'] = $item->cluster_longitude ?? "";
			$epidem_report['comment'] = (string)$item->comment ?? "";

			$lab_report['specimen_date'] = $item->specimen_date ?? "2023-12-22";
			$lab_report['epidem_lab_confirm_type_id'] = $item->epidem_lab_confirm_type_id ?? 1;
			$lab_report['specimen_place_id'] =  $item->specimen_place_id ?? 2;
			$lab_report['lab_report_date'] = $item->lab_report_date ?? "2023-01-01";
			$lab_report['lab_report_result'] = $item->lab_report_result ?? "Positive";
			$lab_report['lab_his_ref_code'] = $item->lab_his_ref_code ?? "111";
			$lab_report['lab_his_ref_name'] = $item->lab_his_ref_name ?? "Sar test";
			$lab_report['tmlt_code'] = $item->tmlt_code ?? "222333";

			$vaccination['vaccine_hospital_code'] =  $item->vaccine_hospital_code ?? "";
			$vaccination['vaccine_date'] = $item->vaccine_date ?? "";
			$vaccination['dose'] = (int)$item->dose ?? 1;
			$vaccination['vaccine_manufacturer'] = $item->vaccine_manufacturer ?? "";

			$data_arr = [
				'hospital' => $hospital,
				'person' => $person,
				'epidem_report' => $epidem_report,
				'lab_report' => $lab_report,
				'vaccination' => [$vaccination],
			];
			$data_json = json_encode(value: $data_arr, flags: JSON_UNESCAPED_UNICODE);
			// $insert_id = $this->store(data: $data_json);
			// array_push($storeDataId, $insert_id);

		} catch(\Exception $e) {
			Log::error(message: $e->getMessage());
		}
	}

	protected function getHisDataToMySql(): Response {
		try {
			Hosp2Bms::chunk(10, function($data) {
				foreach ($data as $item) {
					$d506 = new D506;
					$d506->hospital_code = "10735";
					$d506->hospital_name = "โรงพยาบาลสมเด็จพระพุทธเลิศหล้า";
					$d506->his_identifier = "HOMEC";

					$d506->cid = trim($item->cid) ?? "";
					$d506->passport_no = $item->passport_no ?? "";
					$d506->prefix = $item->prefix ?? "";
					$d506->first_name = $item->first_name ?? "";
					$d506->last_name = $item->last_name ?? "";
					$d506->nationality = $item->nationality ?? "";
					$d506->gender = $item->gender ?? "";
					$d506->birth_date = $item->birthDate ?? '0000-00-00';
					$d506->age_y = $item->age_y ?? 0;
					$d506->age_m = $item->age_m ?? 0;
					$d506->age_d = $item->age_d ?? 0;
					$d506->marital_status_id = $item->marital_status_id ?? "";
					$d506->address = $item->address ?? "";
					$d506->moo = $item->moo ?? "";
					$d506->road = $item->road ?? "";
					$d506->chw_code = $item->chw_code ?? "75";
					$d506->amp_code = $item->amp_code ?? "01";
					$d506->tmb_code = $item->tmb_code ?? "02";
					$d506->mobile_phone = (isset($item->mobile_phone) || !empty($item->mobile_phone)) ? $item->mobile_phone : "";
					$d506->occupation = trim($item->occupation) ?? "";

					$d506->epidem_report_guid = '{'.$item->epidem_report_guid.'}' ?? '{}';
					$d506->epidem_report_group_code = $item->epidem_report_group_id ?? "";
					$d506->treated_hospital_code = $item->treated_hospital_code ?? "";
					$d506->report_datetime = date('Y-m-d').'T'.date('H:i:s').'.000'; //2023-07-05T13:01:05.000'
					$d506->onset_date = $item->onset_date ?? "";
					$d506->treated_date = $item->treated_date ?? "";
					$d506->diagnosis_date = $item->diagnosis_date ?? "";
					$d506->death_date = $item->death_date ?? "";
					$d506->cdeath = (isset($item->cdeath) || !empty($item->cdeath)) ? $item->cdeath : "";
					$d506->informer_name = (isset($item->informer_name) || !empty($item->informer_name)) ? $item->informer_name : "";
					$d506->organism = (isset($item->organism) || !empty($item->organism)) ? $item->organism : "";
					$d506->complication = (isset($item->complication) || !empty($item->complication)) ? $item->complication : "";
					$d506->diagnosis_icd10 = $item->diagnosis_icd10 ?? "";
					$d506->diagnosis_icd10_list = $item->diagnosis_icd10 ?? "";
					$d506->epidem_person_status_id = $item->epidem_person_status_id ?? "";
					$d506->epidem_symptom_type_id = $item->epidem_symptom_type_id ?? "";
					$d506->municipal = $item->municipal ?? 3; // df 3
					$d506->respirator_status = $item->respirator_status ?? "N"; // df N
					$d506->vaccinated_status = $item->vaccinated_status ?? "N"; // df N
					$d506->epidem_address = $item->epidem_address ?? "";
					$d506->epidem_moo = $item->epidem_moo ?? "";
					$d506->epidem_road = $item->epidem_road ?? "";
					$d506->epidem_chw_code = $item->epidem_chw_code ?? "75"; // df 75
					$d506->epidem_amp_code = $item->epidem_amp_code ?? "01"; // df 01
					$d506->epidem_tmb_code = $item->epidem_tmb_code ?? "01"; // df 01
					$d506->location_gis_latitude = (isset($item->location_gis_latitude) || !empty($item->location_gis_latitude)) ? $item->location_gis_latitude : "";
					$d506->location_gis_longitude = (isset($item->location_gis_longitude) || !empty($item->location_gis_longitude)) ? $item->location_gis_longitude : "";
					$d506->isolate_chw_code = $item->isolate_chw_code ?? "75"; // df 75
					$d506->patient_type = $item->patient_type ?? "";
					$d506->active_case_finding = (isset($item->active_case_finding) || !empty($item->active_case_finding)) ? $item->active_case_finding : "";
					$d506->epidem_cluster_type_id = (isset($item->epidem_cluster_type_id) || !empty($item->epidem_cluster_type_id)) ? $item->epidem_cluster_type_id : "";
					$d506->cluster_latitude = (isset($item->cluster_latitude) || !empty($item->cluster_latitude)) ? $item->cluster_latitude : "";
					$d506->cluster_longitude = (isset($item->cluster_longitude) || !empty($item->cluster_longitude)) ? $item->cluster_longitude : "";
					$d506->comment = (isset($item->comment) || !empty($item->comment)) ? trim($item->comment) : "";

					$d506->specimen_date = (isset($item->specimen_date) || !empty($item->specimen_date)) ? $item->specimen_date : "";
					$d506->epidem_lab_confirm_type_id = (isset($item->epidem_lab_confirm_type_id) || !empty($item->epidem_lab_confirm_type_id)) ? $item->epidem_lab_confirm_type_id : "";
					$d506->specimen_place_id =  (isset($item->specimen_place_id) || !empty($item->specimen_place_id)) ? $item->specimen_place_id : "";
					$d506->lab_report_date = (isset($item->lab_report_date) || !empty($item->lab_report_date)) ? : "";
					$d506->lab_report_result = (isset($item->lab_report_result) || !empty($item->lab_report_result)) ? $item->lab_report_result : "";
					$d506->lab_his_ref_code = (isset($item->lab_his_ref_code) || !empty($item->lab_his_ref_code)) ? $item->lab_his_ref_code : "";
					$d506->lab_his_ref_name = (isset($item->lab_his_ref_name) || !empty($item->lab_his_ref_name)) ? $item->lab_his_ref_name : "";
					$d506->tmlt_code = (isset($item->tmlt_code) || !empty($item->tmlt_code)) ? $item->tmlt_code : "";

					$d506->vaccine_hospital_code =  (isset($item->vaccine_hospital_code) || !empty($item->vaccine_hospital_code)) ? $item->vaccine_hospital_code : "";
					$d506->vaccine_date = (isset($item->vaccine_date) || !empty($item->vaccine_date)) ? $item->vaccine_date : "";
					$d506->dose = (isset($item->dose) || !empty($item->dose)) ? $item->dose : "";
					$d506->vaccine_manufacturer = (isset($item->vaccine_manufacturer) || !empty($item->vaccine_manufacturer)) ? $item->vaccine_manufacturer : "";
					$d506->save();
					array_push($this->data_index, $d506->id);
					$d506->delete();
				}
			});
			return response()->noContent();
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	private function send($data) {
		try {
			return Http::withToken(token: $this->token, type: 'Bearer')
				?->withHeaders(headers: ['Content-type' => 'Application/json'])
				?->post(url: $this->send_506_url, data: $data)->getBody();
		} catch (\Exception $e) {
			Log::error(message: $e->getMessage());
		}
	}

	private function getToken(): string {
		try {
			$db_token = ApiConfig::select('id', 'moph_token')->latest()->first();
			$chk_token_expire = $this->checkTokenExpired(token: $db_token['moph_token']);
			if ($chk_token_expire) {
				$this->setToken();
				$token = $this->token;
			} else {
				$token = $db_token['moph_token'];
			}
			return $token;
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	private function checkTokenExpired($token): bool {
		try {
			$e1 = explode(".", $token);
			$decode = base64_decode($e1[1], false);
			$e2 = explode(",", $decode);
			$e3 = explode(":", $e2[2]);
			$expire_date_time = Carbon::createFromTimestamp($e3[1])->format('Y-m-d H:i:s');
			$now_date_time = Carbon::now('Asia/Bangkok');
			$result = $now_date_time->gt($expire_date_time);
			return $result;
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	private function setToken(): void {
		try {
			$pwd_hash = $this->mophHashPassword();
			$token = $this->getMophToken($this->token_url, $this->hosp_user, $pwd_hash, $this->hosp_code);
			$this->token = $token;
			$config = new ApiConfig;
			$config->moph_token_enpoint = $this->token_url;
			$config->moph_send_506_enpoint = $this->send_506_url;
			$config->moph_username = $this->hosp_user;
			$config->moph_password = $this->hosp_password;
			$config->moph_password_hash = $pwd_hash;
			$config->moph_token = $token;
			$config->hosp_name = $this->hosp_name;
			$config->hosp_code = $this->hosp_code;
			$config->save();
			return;
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	private function setEnvFromDb(): void {
		try {
			$data = ApiConfig::latest()->first();
			$this->hosp_code  = $data['hosp_code'];
			$this->hosp_name  = $data['hosp_name'];
			$this->hosp_user  = $data['moph_username'];
			$this->hosp_password = $data['moph_password'];
			$this->token_url = $data['moph_token_enpoint'];
			$this->send_506_url = $data['moph_send_506_enpoint'];
			return;
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	private function mophHashPassword() {
		try {
			$string = DB::connection('mysql')?->select("SELECT HMACSHA256('".$this->moph_secret_key."','".$this->hosp_password."') AS hash");
			return strtoupper($string[0]->hash);
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	private function getMophToken($token_url, $hosp_user, $pwd_hash, $hosp_code): ?string {
		try {
			$end_point = $token_url."&user=".$hosp_user."&password_hash=".$pwd_hash."&hospital_code=".$hosp_code;
			$response = Http::post($end_point, ['verify' => false ]);
			return $response;
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	private function getEnv($var=null): ?string {
		return env($var);
	}
}
