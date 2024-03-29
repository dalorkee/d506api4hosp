<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\{DB,Hash};
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void {
		DB::table('users')->insert([
			'first_name' => 'your firstname',
			'last_name' => 'your lastname',
			'position' => 'your position',
			'email' => 'test@example.com',
			'password' => Hash::make('123456'),
			'remember_token' => Str::random(60),
			'role' => 'admin',
		]);
	}
}
