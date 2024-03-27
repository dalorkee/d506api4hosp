<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
	LogoutController,
	DashboardController,
	ApiConfigController,
	D506Controller,
	ReportController,
	SendD506Controller,
	SendD506ToQueueController,
	ResendD506Controller,
	TokenController,
};
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', fn () => view('auth.login'));
Route::get('/logout', LogoutController::class)->name('dds.logout');
Route::name('d506.')->group(function() {
	Route::resources([
		'dashboard' => DashboardController::class,
		'config' => ApiConfigController::class,
		'send' => SendD506Controller::class,
	]);
	Route::resource('report', ReportController::class)->only(['index', 'create', 'store']);
	Route::get('/report/{id}/edit', [ReportController::class, 'edit'])->name('report.edit');
	Route::get('/d506/get/data', [D506Controller::class, 'getData'])->name('get.data');
	Route::post('send/to/queue', SendD506ToQueueController::class)->name('send.to.queue');
	Route::post('resend', ResendD506Controller::class)->name('resend');
	Route::get('/token', TokenController::class)->name('token');
	Route::post('send/to/dds', [SendD506Controller::class, 'sendToDDS'])->name('send.to.dds');
});
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
Route::fallback(fn () => redirect()->route('dds.logout'));
