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
        Schema::create('police_stations', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // police_station name
            $table->string('pi_name'); // PI name
            $table->string('pi_sign')->nullable(); // PI sign (path or filename)
            $table->string('seal')->nullable(); // Seal (path or filename)
            $table->string('address'); // Address
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('police_stations');
    }
};
