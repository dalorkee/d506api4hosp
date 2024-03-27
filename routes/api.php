<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Hosp2BmsController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
	return $request->user();
});

Route::controller(Hosp2BmsController::class)->group(function() {
	Route::get('uuid', 'getUid');
	Route::get('password', 'hashPassword');
	Route::get('token', 'getMophToken');
	Route::get('lookup/table/name', 'lookupTableName');
	Route::get('lookup/table', 'lookupTable');
	Route::get('del/506/guid/{guid}', 'delete506');
	Route::get('send/506', 'getData');
});
