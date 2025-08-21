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
        Schema::create('cdrs', function (Blueprint $table) {
            $table->id();
            $table->string('nodal_officer')->nullable();
            $table->date('date')->nullable();
            $table->string('outward_no')->nullable();
            $table->string('police_station')->nullable();
            $table->string('mobile_or_imei_no')->nullable();
            $table->date('period_from')->nullable();
            $table->date('period_to')->nullable();
            $table->string('fir_or_case_no')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cdrs');
    }
};
