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
        Schema::create('refunds', function (Blueprint $table) {
            $table->id();
            $table->string('acknowledgement_no')->nullable();
            $table->string('applicant_name');
            $table->string('suspect_bank_account_name')->nullable();
            $table->decimal('amount', 15, 2)->nullable();
            $table->string('suspect_account_number')->nullable();
            $table->date('email_date')->nullable();
            $table->json('email_reminders')->nullable()->comment('Array of reminder dates');
            $table->unsignedInteger('reminder_count')->default(0);
            $table->date('last_reminder_date')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refunds');
    }
};

