<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Services\D506Send;


class SendD506ByUser implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	/**
	 * Create a new job instance.
	 */
	public function __construct(public string $id) {}

	/**
	 * Execute the job.
	 */
	public function handle(): void {
		try {
			$d506Send = new D506Send();
			$d506Send->send506($this->id);
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}
}
