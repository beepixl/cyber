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
		Schema::create('application_records', function (Blueprint $table) {
			$table->id();
			$table->string('name')->nullable();
			$table->text('address')->nullable();
			$table->string('mobile_no', 20)->nullable();
			$table->date('date')->nullable();
			$table->time('time')->nullable();
			$table->string('officer')->nullable();
			$table->text('details_of_application')->nullable();
			$table->text('action_taken')->nullable();
			$table->string('photo')->nullable();
			$table->string('io_name')->nullable();
			$table->string('io_mobile', 20)->nullable();
			$table->text('io_feedback')->nullable();
			$table->text('applicant_feedback')->nullable();
			$table->string('status')->default('pending');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('application_records');
	}
};
