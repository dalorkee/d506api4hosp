<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\D506 as Data;
use Illuminate\Support\Facades\{Gate,Log};

class Counter extends Component
{
	public $data=[];

	public function render(Data $model) {
		try {
			$total = $model::count() ?? 0;
			$this->data['total'] = $total;

			$today = $model::whereDate('created_at', date('Y-m-d' ))->count() ?? 0;
			$this->data['today'] = $today;
			$this->data['todayPercent'] = ($today > 0) ? (($today*100)/$total) : 0;

			$sent = $model::whereStatus('200')->count() ?? 0;
			$this->data['sent'] = $sent;
			$this->data['sentPercent'] = ($sent > 0) ? (($sent*100)/$total) : 0;

			$failed = $model::where('status', '!=', '200')->count() ?? 0;
			$this->data['failed'] = $failed;
			$this->data['failedPercent'] = ($failed > 0) ? (($failed*100)/$total) : 0;

			return view('livewire.dashboard.counter');
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}
}
