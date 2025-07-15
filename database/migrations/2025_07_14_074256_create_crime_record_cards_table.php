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
        Schema::create('crime_record_cards', function (Blueprint $table) {
            $table->id();
            $table->longText('police_station_name')->nullable();
            $table->longText('record_date')->nullable();
            $table->longText('name')->nullable();
            $table->longText('alias')->nullable();
            $table->longText('age')->nullable();
            $table->longText('fp_classification')->nullable();
            $table->longText('place_of_birth')->nullable();
            $table->longText('height')->nullable();
            $table->longText('complexion')->nullable();
            $table->longText('build')->nullable();
            $table->longText('hair')->nullable();
            $table->longText('eyes')->nullable();
            $table->longText('identification_marks')->nullable();
            $table->longText('languages_known')->nullable();
            $table->longText('religion_caste')->nullable();
            $table->longText('education')->nullable();
            $table->longText('address')->nullable();
            $table->longText('date_of_photograph')->nullable();
            $table->longText('police_officers')->nullable();
            $table->longText('movements_info')->nullable();
            $table->longText('convictions_summary')->nullable();
            $table->longText('relatives_friends')->nullable();
            $table->longText('father_name')->nullable();
            $table->longText('spouse_name')->nullable();
            $table->longText('associates_in_crime')->nullable();
            $table->longText('receivers')->nullable();
            $table->longText('mo_classification')->nullable();
            $table->longText('general_particulars')->nullable();
            $table->longText('fir_numbers')->nullable();
            $table->longText('dress_description')->nullable();
            $table->longText('style_description')->nullable();
            $table->longText('habits_vices')->nullable();
            $table->longText('sphere_of_activity')->nullable();
            $table->longText('antecedents')->nullable();
            $table->longText('cp_reference')->nullable();
            $table->longText('ho_memo_no')->nullable();
            $table->longText('red_no_of_p_stn')->nullable();
            $table->longText('dist_mob_no')->nullable();
            $table->longText('cid_no')->nullable();
            $table->longText('frequents_of_stays_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crime_record_cards');
    }
};
