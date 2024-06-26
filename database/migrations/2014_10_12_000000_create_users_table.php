<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::create('users', function (Blueprint $table) {
			$table->id();
			$table->string('first_name', 191);
			$table->string('last_name', 191);
			$table->string('position', 191)->nullable();
			$table->string('email', 191)->unique();
			$table->timestamp('email_verified_at')->nullable();
			$table->string('password', 191);
			$table->enum('role', ['admin', 'staff', 'user'])->default('staff');
			$table->rememberToken();
			$table->foreignId('current_team_id')->nullable();
			$table->string('profile_photo_path', 191)->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('users');
	}
};
