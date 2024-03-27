<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Gate,Log};
use App\Services\D506Send;

class ResendD506Controller extends Controller
{
	public function __invoke(Request $request): ?object {
		try {
			if (Gate::none(['isAdmin', 'isStaff'])) {
				return redirect()->back()->with('error', 'โปรดตรวจสอบสิทธิ์การใช้งาน');
			}

			$d506 = new D506Send();
			$response = $d506->send506($request->id);
			if ($response['MessageCode'] == 200) {
				$type = 'success';
				$message = 'ส่งข้อมูลสำเร็จแล้ว';
			} else {
				$type = 'error';
				$message = $response['Message'];
			}
			return redirect()->back()->with(key: $type, value: $message);
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->back()->with(key: 'error', value: $e->getMessage());
		}
	}
}
