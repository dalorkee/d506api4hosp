<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\{ShouldBeUnique,ShouldQueue};
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\{InteractsWithQueue,SerializesModels};
use Illuminate\Support\Facades\{Http,Log,DB};
use Illuminate\Support\Sleep;
use App\Models\{ApiConfig,D506};
use Carbon\Carbon;

class SendD506 implements ShouldQueue
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
	protected int $last_insert_id;

	public function __construct($last_insert_id) {
		$this->setEnvFromDb();
		$this->moph_secret_key = $this->getEnv(var: 'MOPH_SECRET');
		$this->token = $this->getToken();
		$this->last_insert_id = $last_insert_id;
	}

	public function handle() {
		try {
			// if (!empty($this->store_data_id)) {
				// foreach ($this->store_data_id as $val) {
					$d506 = D506::findOr($this->last_insert_id, fn () => throw new \Exception('ไม่พบข้อมูลรหัส: '.$this->last_insert_id));
					$data = preg_replace(pattern: "/\r|\n|\t/", replacement: "", subject: $d506->data);
					$data = json_decode(json: $data, associative: true);
					$response = $this->send(data: $data);
					$response = json_decode(json: $response, associative: true);
					if (count($response) > 0) {
						$d506->message_code = $response['MessageCode'];
						$d506->message = $response['Message'];
						$d506->request_time = $response['RequestTime'];
						$d506->endpoint_port = $response['EndpointPort'];
						$d506->status = ($response['MessageCode'] == 200) ? 'sent' : 'fail';
						$d506->attempt = ($d506->attempt+1);
						$d506->save();
					}
					// $d506->delete();
				// }
			// }
		} catch (\Exception $e) {
			Log::error(message: $e->getMessage());
		}
	}

	private function send($data) {
		try {
			return Http::withToken(token: $this->token, type: 'Bearer')
				->withHeaders(headers: ['Content-type' => 'Application/json'])
				->post(url: $this->send_506_url, data: $data)->getBody();
		} catch (\Exception $e) {
			Log::error(message: $e->getMessage());
		}
	}

	private function getToken(): string {
		try {
			$db_token = ApiConfig::select('id', 'moph_token')?->latest()?->first();
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
			$string = DB::connection('mysql')->select("SELECT HMACSHA256('".$this->moph_secret_key."','".$this->hosp_password."') AS hash");
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
