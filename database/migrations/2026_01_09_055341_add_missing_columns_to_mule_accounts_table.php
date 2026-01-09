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
        Schema::table('mule_accounts', function (Blueprint $table) {
            // Add bank_branch if it doesn't exist
            if (!Schema::hasColumn('mule_accounts', 'bank_branch')) {
                $table->string('bank_branch')->nullable()->after('id');
            }
            // Add outward_no if it doesn't exist
            if (!Schema::hasColumn('mule_accounts', 'outward_no')) {
                $table->string('outward_no')->nullable()->after('bank_branch');
            }
            // Add nodal_officer if it doesn't exist
            if (!Schema::hasColumn('mule_accounts', 'nodal_officer')) {
                $table->string('nodal_officer')->nullable()->after('outward_no');
            }
            // Add bank_branch_address
            $table->text('bank_branch_address')->nullable()->after('address');
            // Add reply letter dates
            $table->date('reply_letter_sent_to_bank_dt')->nullable()->after('layers');
            $table->date('reply_letter_received_from_bank_dt')->nullable()->after('reply_letter_sent_to_bank_dt');
            // Add account holder information
            $table->text('acc_holder_address')->nullable()->after('reply_letter_received_from_bank_dt');
            $table->string('acc_holder_police_station')->nullable()->after('acc_holder_address');
            $table->date('holder_nivedan_taken_dt')->nullable()->after('acc_holder_police_station');
            // Add remarks
            $table->text('remarks')->nullable()->after('holder_nivedan_taken_dt');
            // Add action taken
            $table->text('action_taken')->nullable()->after('remarks');
            $table->date('action_taken_date')->nullable()->after('action_taken');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mule_accounts', function (Blueprint $table) {
            $table->dropColumn([
                'bank_branch_address',
                'reply_letter_sent_to_bank_dt',
                'reply_letter_received_from_bank_dt',
                'acc_holder_address',
                'acc_holder_police_station',
                'holder_nivedan_taken_dt',
                'remarks',
                'action_taken',
                'action_taken_date',
            ]);
        });
    }
};
