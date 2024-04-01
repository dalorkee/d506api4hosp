<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('d506_data', function (Blueprint $table) {
			$table->id();
			$table->text('data')->nullable();
			$table->string('cid', 90)->nullable();
			$table->string('passport_no', 90)->nullable();
			$table->string('prefix')->nullable();
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('gender')->nullable();
			$table->string('epidem_report_guid')->nullable();
			$table->string('hn')->nullable();
			$table->string('reg_no')->nullable();
			$table->string('visit_date')->nullable();
			$table->string('diag_date')->nullable();
			$table->string('last_diag_date')->nullable();
			$table->string('last_update')->nullable();
			$table->string('message_code')->nullable();
			$table->string('message')->nullable();
			$table->string('request_time')->nullable();
			$table->string('endpoint_port')->nullable();
			$table->enum('status', ['new', 'sent', 'fail'])->nullable();
			$table->integer('attempt')->default(0)->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('d506_data');
	}
};
