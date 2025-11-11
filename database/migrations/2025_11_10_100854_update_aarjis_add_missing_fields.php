<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('aarjis', function (Blueprint $table) {
            // Add new fields if not present
            if (!Schema::hasColumn('aarjis', 'no')) {
                $table->string('no')->nullable()->after('id');
            }
            if (!Schema::hasColumn('aarjis', 'ack_no')) {
                $table->string('ack_no')->nullable()->after('no');
            }
            if (!Schema::hasColumn('aarjis', 'complaint_date')) {
                $table->date('complaint_date')->nullable()->after('ack_no');
            }
            if (!Schema::hasColumn('aarjis', 'police_station')) {
                $table->string('police_station')->nullable()->after('complaint_date');
            }

            // Add soft deletes
            if (!Schema::hasColumn('aarjis', 'deleted_at')) {
                $table->softDeletes();
            }
        });
    }

    public function down(): void
    {
        Schema::table('aarjis', function (Blueprint $table) {
            $table->dropColumn(['no', 'ack_no', 'complaint_date', 'police_station', 'deleted_at']);
        });
    }
};
