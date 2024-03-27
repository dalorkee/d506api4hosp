<?php

namespace App\Services;

use Illuminate\Support\Facades\{DB,Log,Http};
use App\Models\ApiConfig;
use Carbon\Carbon;

class MophToken
{
	private static ?string $token;
	private static ?string $expire_date_time;

	public function __construct() {
		self::$token = null;
		self::$expire_date_time = null;
	}

	public static function getToken(): ?string {
		try {
			$data = ApiConfig::latest()?->first();
			if (!empty($data) && $data->count() > 0) {
				$chk_expire_token = self::checkTokenExpired(token: $data['moph_token']);
				self::$token = ($chk_expire_token === true) ? self::setToken() : $data['moph_token'];
			} else {
				self::$token = self::setToken();
			}
			return self::$token;
		} catch (\Exception $e) {
			Log::error('MophToekn::getToken(): error: '.$e->getMessage());
			return null;
		}
	}

	public static function checkTokenExpired(string $token=""): bool {
		try {
			if (!empty($token)) {
				$str1 = explode(".", $token);
				$decode = base64_decode($str1[1], false);
				$str2 = explode(",", $decode);
				$str3 = explode(":", $str2[2]);
				$now_date_time = Carbon::now(tz: 'Asia/Bangkok');
				$expire_date_time = Carbon::createFromTimestamp(timestamp: $str3[1], tz: 'Asia/Bangkok')->subHour(12)->format('Y-m-d H:i:s');
				$result = $now_date_time->gt(date: $expire_date_time);
			} else {
				$result = true;
			}
			return $result;
		} catch (\Exception $e) {
			Log::error('Check token error or expired: '.$e->getMessage());
			return true;
		}
	}

	public static function setToken(): string|bool {
		try {
			$data = [
				'moph_token_enpoint' => env('MOPH_TOKEN_URL'),
				'moph_send_506_enpoint' => env('MOPH_SEND_506_URL'),
				'moph_username' => env('HOSP_USER'),
				'moph_password' => env('HOSP_PASSWORD'),
				'moph_password_hash' => self::getMophPasswordHash(),
				'hosp_name' => env('HOSP_NAME'),
				'hosp_code' => env('HOSP_CODE'),
			];

			$moph_token = self::getMophToken(
				enpoint: $data['moph_token_enpoint'],
				user: $data['moph_username'],
				password: $data['moph_password_hash'],
				hosp_code: $data['hosp_code']
			);

			if ($moph_token !== false) {
				$token_expire = self::getExpireDateFromMophToken(token: $moph_token);
				$config = new ApiConfig;
				$config->moph_token_enpoint = $data['moph_token_enpoint'];
				$config->moph_send_506_enpoint = $data['moph_send_506_enpoint'];
				$config->moph_username = $data['moph_username'];
				$config->moph_password = $data['moph_password'];
				$config->moph_password_hash = $data['moph_password_hash'];
				$config->moph_token = $moph_token;
				$config->moph_token_expire = $token_expire;
				$config->hosp_name = $data['hosp_name'];
				$config->hosp_code = $data['hosp_code'];
				$config->save();
				return $moph_token;
			} else {
				throw new \Exception('MOPH token not responsed.');
			}
		} catch (\Exception $e) {
			Log::error('Set new token error: '.$e->getMessage());
			return false;
		}
	}

	public static function getMophToken($enpoint, $user, $password, $hosp_code): string|bool {
		try {
			$url = $enpoint."&user=".$user."&password_hash=".$password."&hospital_code=".$hosp_code;
			$response = Http::post($url, ['verify' => false ]);
			if (gettype($response) === 'object') {
				return strval($response);
			} else {
				throw new \Exception('Invalid MOPH Token.');
			}
		} catch (\Exception $e) {
			Log::error('Get Moph token error: '.$e->getMessage());
			return false;
		}
	}

	public static function getMophPasswordHash(): ?string {
		try {
			$moph_secret_key = env('MOPH_SECRET');
			$hosp_password = env('HOSP_PASSWORD');
			$string = DB::connection('mysql')->select("SELECT HMACSHA256('".$moph_secret_key."','".$hosp_password."') AS hash");
			return strtoupper($string[0]->hash);
		} catch (\Exception $e) {
			Log::error('Hash moph password failed: '.$e->getMessage());
			return null;
		}
	}

	public static function getExpireDateFromMophToken($token): ?string {
		try {
			$e1 = explode(".", $token);
			$decode = base64_decode($e1[1], false);
			$e2 = explode(",", $decode);
			$e3 = explode(":", $e2[2]);
			self::$expire_date_time = Carbon::createFromTimestamp(timestamp: $e3[1], tz: 'Asia/Bangkok')->format('Y-m-d H:i:s');
			return self::$expire_date_time;
		} catch (\Exception $e) {
			Log::error('Get moph expire token error: '.$e->getMessage());
			return null;
		}
	}
}
