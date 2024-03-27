<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Jobs\SendD506ByUser;

class SendD506ToQueueController extends Controller
{
	public function __invoke(Request $request): string {
		if (Gate::none(['isAdmin', 'isStaff'])) {
			return redirect()->back()->with('error', 'โปรดตรวจสอบสิทธิ์การใช้งาน');
		}

		/* ** send by job and queue process *** */
		SendD506ByUser::dispatch($request->id)->onQueue(queue: 'd506');
		return 'processing';
	}
}
