<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Models\D506Code;

class D506CodeService
{
	private ?object $code_506;

	public function __construct() {
		$this->code_506 = collect();
	}

	public function code506(string $icd10): ?object {
		try {
			$this->code_506 = D506Code::select('code_506')?->whereCode(strtoupper($icd10))?->get();
			return $this;
		} catch (\Exception $e) {
			Log::error('D506 Code Service: ผิดพลาด: '.$e->getMessage());
		}
	}

	public function get(): ?string {
		if ($this->code_506->count() > 0) {
			return trim($this->code_506[0]->code_506);
		} else {
			return "";
		}
	}
}
