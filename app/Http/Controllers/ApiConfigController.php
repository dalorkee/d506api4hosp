<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Gate,Log};
use App\Models\ApiConfig;
use App\Services\MophToken;

class ApiConfigController extends Controller
{
	public string $moph_secret_key;

	public function __construct() {
		$this->moph_secret_key = env('MOPH_SECRET');
	}

	protected function create(): object {
		if (Gate::none(['isAdmin', 'isStaff'])) {
			return redirect()->route('logout');
		}

		$data = ApiConfig::latest()->first();
		return view(view: 'apps.config.create', data: compact('data'));
	}

	public function store(Request $request) {
		$request->validate([
			'moph_token_enpoint' => 'required',
			'moph_send_506_enpoint' => 'required',
			'moph_username' => 'required',
			'moph_password' => 'required',
			'moph_password_hash' => 'nullable',
			'moph_token' => 'nullable',
			'moph_token_expire' => 'nullable',
			'hosp_name' => 'nullable',
			'hosp_code' => 'required',
		],[
			'moph_token_enpoint.required' => 'โปรดกรอก Token',
			'moph_send_506_enpoint.required' => 'โปรดกรอก Endpoint สำหรับส่ง API',
			'moph_username.required' => 'โปรดกรอก Username',
			'moph_password.required' => 'โปรดกรอก Password',
			'hosp_code.required' => 'โปรดกรอกรหัสโรงพยาบาล',
		]);
		try {
			if (Gate::none(['isAdmin', 'isStaff'])) {
				return redirect()->route('logout');
			}

			$pwd_hash = MophToken::getMophPasswordHash($request->moph_password);
			$token = MophToken::getMophToken($request->moph_token_enpoint, $request->moph_username, $pwd_hash, $request->hosp_code);

			$config = new ApiConfig;
			$config->moph_token_enpoint = $request->moph_token_enpoint;
			$config->moph_send_506_enpoint = $request->moph_send_506_enpoint;
			$config->moph_username = $request->moph_username;
			$config->moph_password = $request->moph_password;
			$config->moph_password_hash = $pwd_hash;
			$config->moph_token = $token;
			$config->moph_token_expire = MophToken::getExpireDateFromMophToken($token);
			$config->hosp_name = env('HOSP_NAME');
			$config->hosp_code = $request->hosp_code;
			$config->save();
			return redirect()->back()->with(key: 'success', value: 'บันทึกข้อมูลสำเร็จ');
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->back()->with(key: 'error', value: $e->getMessage());
		}
	}

}
