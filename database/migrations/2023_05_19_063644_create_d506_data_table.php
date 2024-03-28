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
			$table->text('data');
			$table->string('cid', 90);
			$table->string('passport_no', 90);
			$table->string('prefix');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('gender');
			$table->string('epidem_report_guid');
			$table->string('hn');
			$table->string('reg_no');
			$table->string('visit_date');
			$table->string('diag_date');
			$table->string('last_diag_date');
			$table->string('last_update');
			$table->string('message_code');
			$table->string('message');
			$table->string('request_time');
			$table->string('endpoint_port');
			$table->enum('status', ['new', 'sent', 'fail']);
			$table->integer('attempt')->default(0);
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
