<?php

namespace App\Services;

use Illuminate\Support\Facades\{Http,Log};
use App\Services\MophToken;
use App\Models\D506;
use App\Interfaces\SendData;

class D506Send implements SendData
{
	public ?string $token;
	protected ?string $send_endpoint;

	public function __construct() {
		$this->token = (new MophToken())?->getToken();
		$this->send_endpoint = env('MOPH_SEND_506_URL');
	}

	public function send506MassAssign(array $group_of_id): ?bool {
		try {
			if (count($group_of_id) > 0) {
				foreach ($group_of_id as $id) {
					$sent = $this->send506(id: $id);
					sleep(2);
				}
			}
			return true;
		} catch (\Exception $e) {
			Log::error('D506Send::send506MassAssign() Error! ส่งข้อมูลไม่สำเร็จ');
			return false;
		}
	}

	public function send506($id): null|array|string|object {
		try {
			$d506 = D506::find($id);
			if (!empty($d506) && !empty($d506->data)) {
				$data = preg_replace(pattern: "/\r|\n|\t/", replacement: "", subject: $d506->data);
				$json_data = json_decode(json: $data, associative: true);
				$response = $this->send(data: $json_data);
				if (!empty($response)) {
					$response = json_decode(json: $response, associative: true);
					if (count($response) > 0) {
						if (array_key_exists('StatusCode', $response) && $response['StatusCode'] == 500) {
							$d506->message_code = $response['StatusCode'];
							$d506->message = $response['StatusText'];
							$d506->save();
						} else {
							$d506->message_code = $response['MessageCode'];
							$d506->message = $response['Message'];
							$d506->request_time = $response['RequestTime'];
							$d506->endpoint_port = $response['EndpointPort'];
							$d506->status = $response['MessageCode'];
							$d506->attempt = ($d506->attempt+1);
							$d506->save();
						}
					}
				}
			}
			return true;
		} catch (\Exception $e) {
			Log::error('D506Send::send506() เตรียมส่งข้อมูลผิดพลาด: '.$e->getMessage());
			return false;
		}
	}

	public function send($data): ?string {
		try {
			$response = Http::withToken(token: $this->token, type: 'Bearer')
				->withHeaders(headers: ['Content-type' => 'Application/json'])
				->post(url: $this->send_endpoint, data: $data)
				->getBody();
			return $response;
		} catch (\Exception $e) {
			Log::error('D506Send::send() ส่งข้อมูลไม่สำเร็จ: '.$e->getMessage());
			return null;
		}
	}
}
