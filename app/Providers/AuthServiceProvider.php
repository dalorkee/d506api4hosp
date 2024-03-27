<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
	/**
	 * The model to policy mappings for the application.
	 *
	 * @var array<class-string, class-string>
	 */
	protected $policies = [
		//
	];

	protected $gates = [
		'isAdmin' => 'admin',
		'isStaff' => 'staff',
		'isUser' => 'user'
	];

	/**
	 * Register any authentication / authorization services.
	 */
	public function boot(): void {
		$this->registerGates();
	}

	public function registerGates(): void {
		foreach ($this->gates as $key => $value) {
			Gate::define($key, fn (User $user) => $user->role === $value);
		}
	}
}
