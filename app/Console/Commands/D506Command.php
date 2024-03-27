<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\{D506Prepare,D506Send,D506Store};
use App\Models\{Hosp2Bms,D506Hosp};

class D506Command extends Command
{
	protected $signature = 'app:d506';
	protected $description = 'Send d506 via API';
	protected $d506SendService;
	protected $d506PrepareService;
	protected $d506StoreService;

	public function __construct(D506Prepare $d506PrepareService, D506Send $d506SendService, D506Store $d506StoreService) {
		parent::__construct();
		$this->d506SendService = $d506SendService;
		$this->d506PrepareService = $d506PrepareService;
		$this->d506StoreService = $d506StoreService;
	}

	public function handle(): void {
		$id_group = [];
		// Hosp2Bms::chunk(10, function($data) use (&$id_group) {
		D506Hosp::where('id', '<=', 2)?->chunk(2, function($data) use (&$id_group) {
			foreach ($data as $item) {
				$json_data = $this->d506PrepareService?->setDataToJson(item: $item);
				$plain_data = $this->d506PrepareService?->setDataToArray(item: $item);
				$ins_id = $this->d506StoreService?->store(json: $json_data, data: $plain_data);
				array_push($id_group, $ins_id);
			}
		});
		$this->d506SendService?->send506MassAssign(id_group: $id_group);
	}
}
