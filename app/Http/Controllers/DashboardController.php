<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Gate,Log,Auth,Session};

class DashboardController extends Controller
{
	protected function index(): mixed {
		if (Gate::any(['isStaff', 'isAdmin', 'isUser'])) {
			return view(view: 'apps.dashboard.index');
		}
		return redirect()->route('logout');
	}
}
