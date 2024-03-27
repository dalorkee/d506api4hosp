<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Models\D506;

class D506Store
{
	public function store(?string $json, ?array $data): ?int {
		try {
			$d506 = new D506;
			$d506->data = $json;
			$d506->cid = $data['cid'] ?? "";
			$d506->passport_no = $data['passport_no'];
			$d506->prefix = $data['prefix'];
			$d506->first_name = $data['first_name'];
			$d506->last_name = $data['last_name'];
			$d506->gender = $data['gender'];
			$d506->epidem_report_guid = $data['epidem_report_guid'];
			$d506->hn = $data['hn'];
			$d506->reg_no = $data['reg_no'];
			$d506->visit_date = $data['visit_date'];
			$d506->diag_date = $data['diag_date'];
			$d506->last_diag_date = $data['last_diag_date'];
			$d506->last_update = $data['last_update'];
			$d506->save();
			return (int)$d506->id;
		} catch (\Exception $e) {
			Log::error('Store D506 failed:' .$e->getMessage());
			return null;
		}
	}

	public function storeFromRequest(int $id, string $json, array $data) {
		try {
			$d506 = D506::findOr($id, fn () => throw new \Exception('D506Send::send506FromRequest() ไม่พบข้อมูลรหัส: '.$id));
			$d506->data = $json;

			$d506->cid = $data['cid'] ?? "";
			$d506->passport_no = $data['passport_no'];
			$d506->prefix = $data['prefix'];
			$d506->first_name = $data['first_name'];
			$d506->last_name = $data['last_name'];
			$d506->gender = $data['gender'];
			$d506->epidem_report_guid = $data['epidem_report_guid'];
			$d506->save();
			return (int)$d506->id;
		} catch (\Exception $e) {
			Log::error('Store D506 failed:' .$e->getMessage());
			return null;
		}
	}
}
