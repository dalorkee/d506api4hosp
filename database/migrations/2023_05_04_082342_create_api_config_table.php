<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

	public function up(): void {
		Schema::create('api_config', function (Blueprint $table) {
			$table->increments('id');
			$table->string('moph_token_enpoint', 191);
			$table->string('moph_send_506_enpoint', 191);
			$table->string('moph_username', 30);
			$table->string('moph_password', 191);
			$table->string('moph_password_hash', 191);
			$table->text('moph_token')->nullable();
			$table->dateTime('moph_token_expire')->nullable();
			$table->string('hosp_name', 90)->nullable();
			$table->string('hosp_code', 30)->nullable();
			$table->timestamps();
		});
	}

	public function down(): void {
		Schema::dropIfExists('api_config');
	}
};
