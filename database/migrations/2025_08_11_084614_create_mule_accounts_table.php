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
            Schema::create('mule_accounts', function (Blueprint $table) {
                $table->id();
                $table->string('acknowledgement_no')->nullable();
                $table->string('account_no')->nullable();
                $table->string('ifsc_code')->nullable();
                $table->text('address')->nullable();
                $table->string('district')->nullable();
                $table->string('state')->nullable();
                $table->string('pin_code', 10)->nullable();
                $table->decimal('transaction_amount', 15, 2)->nullable();
                $table->decimal('disputed_amount', 15, 2)->nullable();
                $table->string('bank_fis')->nullable();
                $table->integer('layers')->nullable();
                $table->timestamps();
            });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mule_accounts');
    }
};
