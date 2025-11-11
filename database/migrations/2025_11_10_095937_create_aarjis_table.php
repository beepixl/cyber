<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('aarjis', function (Blueprint $table) {
            $table->id();
            $table->string('applicant_name'); // અરજદારનું નામ
            $table->string('mobile_number'); // અરજદારનો મોબાઇલ નંબર
            $table->text('address')->nullable(); // સરનામું
            $table->string('fraud_type')->nullable(); // ફ્રોડ ટાઇપ
            $table->decimal('fraud_amount', 15, 2)->nullable(); // ફ્રોડ રકમ
            $table->string('investigator')->nullable(); // તપાસ કરનાર
            $table->string('application_status')->default('Pending'); // અરજી સ્ટેટસ
            $table->date('closed_at_police_station')->nullable(); // અરજી પો. સ્ટે. ખાતે ક્લોઝ કર્યા તા.
            $table->date('closed_at_nccrp')->nullable(); // NCCRP પોર્ટલ પર ક્લોઝ કર્યા તારીખ
            $table->string('fir_number')->nullable(); // FIR નંબર
            $table->date('fir_date')->nullable(); // FIR તારીખ
            $table->text('remarks')->nullable(); // રીમાર્કસ
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aarjis');
    }
};
