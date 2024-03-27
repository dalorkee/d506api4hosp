<?php

namespace App\Traits;

Trait Common {
	public function titleName(): array {
		return [
			1 => 'นาย',
			2 => 'นาง',
			3 => 'นางสาว',
			4 => 'ด.ช.',
			5 => 'ด.ญ.'
		];
	}
	public function gender(): array {
		return [
			1 => 'ชาย',
			2 => 'หญิง'
		];
	}
	public function maritalStatus(): array {
		return [
			1 => 'โสด',
			2 => 'คู่',
			3 => 'หย่าร้าง',
			4 => 'หม้าย',
			5 => 'ไม่ทราบ'
		];
	}
	public function personStatus(): array {
		return [
			1 => 'หายจากโรคแล้ว',
			2 => 'เสียชีวิต',
			3 => 'ยังรักษาอยู่',
			4 => 'ไม่ทราบ'
		];
	}
	public function respiratorStatus(): array {
		return [
			'Y' => 'ใส่',
			'N' => 'ไม่ใส่'
		];
	}
	public function vaccinatedStatus(): array {
		return [
			'Y' => 'ได้รับ',
			'N' => 'ไม่ได้รับ'
		];
	}
	public function labResult(): array {
		return [
			'positive' => 'Positive',
			'negative' => 'Negative',
		];
	}
	public function patientType(): array {
		return [
			'OPD' => 'OPD',
			'IPD' => 'IPD',
		];
	}
}
