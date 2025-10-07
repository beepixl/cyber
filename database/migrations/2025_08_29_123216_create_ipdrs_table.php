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
        Schema::create('ipdrs', function (Blueprint $table) {
            $table->id();
            $table->string('nodal_officer')->nullable();
            $table->date('date')->nullable();
            $table->string('outward_no')->nullable();
            $table->string('police_station')->nullable();

            // IPDR entries stored as JSON array
            $table->json('entries')->nullable();

            $table->dateTime('period_from')->nullable();
            $table->dateTime('period_to')->nullable();
            $table->string('fir_or_case_no')->nullable();
            $table->string('sho')->nullable();
            $table->string('contact_sho')->nullable();
            $table->string('officer')->nullable();
            $table->timestamps();
             $table->softDeletes(); // <-- Soft delete support
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ipdrs');
    }
};
