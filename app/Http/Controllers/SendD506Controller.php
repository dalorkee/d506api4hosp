<?php

namespace App\Http\Controllers;

// use Illuminate\Http\{Request,Response};
use Illuminate\Support\Facades\{Gate,Log};
use App\Services\{D506Prepare,D506Send,D506Store};
use App\Models\{ApiConfig,Hosp2Bms,D506Hosp};
use Carbon\Carbon;

class SendD506Controller extends Controller
{
	protected $d506PrepareService;
	protected $d506StoreService;
	protected $d506SendService;

	public function __construct(D506Prepare $d506PrepareService, D506Store $d506StoreService, D506Send $d506SendService) {
		$this->d506PrepareService = $d506PrepareService;
		$this->d506StoreService = $d506StoreService;
		$this->d506SendService = $d506SendService;
	}

	protected function create(): mixed {
		if (Gate::any(['isAdmin', 'isStaff'])) {
			$data = ApiConfig::latest()->first();
			if (is_null($data) || empty($data)) {
				return redirect()->back()->with('error', 'โปรดตรวจสอบการตั้งค่าการส่ง API');
			} elseif (str_contains($data['moph_token'], 'MessageCode')) {
				$response = json_decode($data['moph_token']);
				return redirect()->back()->with('error', $response->Message);
			}

			$tokenExpireDate = Carbon::parse($data['moph_token_expire']);
			$nowDate = Carbon::now();
			$result = $nowDate->gt($tokenExpireDate);
			if ($result == true) {
				return redirect()->back()->with('error', 'MOPH Token หมดอายุ โปรดตั้งค่าการส่ง API ใหม่');
			}
			return view('apps.send.create', compact('data'));
		}
		return redirect()->route('logout');
	}

	public function sendToDDS(): mixed {
		try {
			if (Gate::none(['isAdmin', 'isStaff'])) {
				return redirect()->back()->with('error', 'Permission denied');
			}

			$group_of_id = [];
			D506Hosp::where('id', '<=', 5)->chunk(5, function($data) use (&$group_of_id) {
				// Hosp2Bms::chunk(100, function($data) use (&$group_of_id) {
				foreach ($data as $item) {
					$json_data = $this->d506PrepareService->setDataToJson(item: $item);
					if (!is_null($json_data)) {
						$plain_data = $this->d506PrepareService->setDataToArray(item: $item);
						$insert_id = $this->d506StoreService->store(json: $json_data, data: $plain_data);
						array_push($group_of_id, $insert_id);
					}
				}
			});
			if (count($group_of_id) > 0) {
				$response = $this->d506SendService->send506MassAssign(group_of_id: $group_of_id);
				if ($response == true) {
					return response()->json([
						'textStatus' => 'success',
						'message' => 'ส่งข้อมูล D506 สำเร็จ'
					], 200);
				} else {
					return response()->json([
						'textStatus' => 'error',
						'message' => 'ไม่สามารถส่งข้อมูลได้ โปรดตรวจสอบ'
					], 503);
				}
			} else {
				return response()->json([
					'textStatus' => 'error',
					'message' => 'ไม่พบข้อมูลที่ต้องการส่งในตาราง HIS'
				], 404);
			}
		} catch (\Exception $e) {
			Log::error('ส่งข้อมูลไม่สำเร็จ: '.$e->getMessage());
			return response()->json([
				'textStatus' => 'error',
				'message' => $e->getMessage()
			], 500);
		}
	}

}
