<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\{Gate,Log};
use Spatie\ScheduleMonitor\Models\MonitoredScheduledTaskLogItem;

class Kernel extends ConsoleKernel {
	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		Commands\D506Command::class,
	];

	/**
	 * Define the application's command schedule.
	 */
	protected function schedule(Schedule $schedule): void {
		$schedule->command('app:d506')
			// ->dailyAt('02:00')
			// ->hourly()
			->everyFiveMinutes()
			->timezone('Asia/Bangkok')
			->onSuccess(fn () => Log::info('schedule run success'))
			->onFailure(fn () => Log::error('schedule run failed'))
			->monitorName('d506');

		$schedule->command('model:prune', ['--model' => MonitoredScheduledTaskLogItem::class])->daily();
	}

	/**
	 * Register the commands for the application.
	 */
	protected function commands(): void {
		$this->load(__DIR__.'/Commands');
		require base_path('routes/console.php');
	}
}
