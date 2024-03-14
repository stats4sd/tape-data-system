<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('caets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farm_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('assessment_date')->nullable();

            $table->decimal('crops', 8, 2)->nullable();
            $table->decimal('animals', 8, 2)->nullable();
            $table->decimal('trees', 8, 2)->nullable();
            $table->decimal('div_activ', 8, 2)->nullable();
            $table->decimal('sum_diversity', 8, 2)->nullable();
            $table->decimal('stand_diversity', 8, 2)->nullable();

            $table->decimal('cla_int', 8, 2)->nullable();
            $table->decimal('s_plant', 8, 2)->nullable();
            $table->decimal('tree_int', 8, 2)->nullable();
            $table->decimal('connectivity', 8, 2)->nullable();
            $table->decimal('sum_syn', 8, 2)->nullable();
            $table->decimal('stand_syn', 8, 2)->nullable();

            $table->decimal('rec_biomass', 8, 2)->nullable();
            $table->decimal('waste', 8, 2)->nullable();
            $table->decimal('water', 8, 2)->nullable();
            $table->decimal('ren_energy', 8, 2)->nullable();
            $table->decimal('sum_rec', 8, 2)->nullable();
            $table->decimal('stand_rec', 8, 2)->nullable();

            $table->decimal('ext_inp', 8, 2)->nullable();
            $table->decimal('soil_fert', 8, 2)->nullable();
            $table->decimal('pest_dis', 8, 2)->nullable();
            $table->decimal('emergingefficiency', 8, 2)->nullable();
            $table->decimal('sum_eff', 8, 2)->nullable();
            $table->decimal('stand_eff', 8, 2)->nullable();

            $table->decimal('vuln', 8, 2)->nullable();
            $table->decimal('indebt', 8, 2)->nullable();
            $table->decimal('averdiv', 8, 2)->nullable();
            $table->decimal('averself_suff_empowerment', 8, 2)->nullable();
            $table->decimal('sum_res', 8, 2)->nullable();
            $table->decimal('stand_res', 8, 2)->nullable();

            $table->decimal('diet', 8, 2)->nullable();
            $table->decimal('food_self_suff', 8, 2)->nullable();
            $table->decimal('food_heritage', 8, 2)->nullable();
            $table->decimal('seeds_breeds', 8, 2)->nullable();
            $table->decimal('sum_cultfood', 8, 2)->nullable();
            $table->decimal('stand_cultfood', 8, 2)->nullable();

            $table->decimal('ae_know', 8, 2)->nullable();
            $table->decimal('platforms', 8, 2)->nullable();
            $table->decimal('partic_orgs', 8, 2)->nullable();
            $table->decimal('sum_cocrea', 8, 2)->nullable();
            $table->decimal('stand_cocrea', 8, 2)->nullable();

            $table->decimal('women', 8, 2)->nullable();
            $table->decimal('labour', 8, 2)->nullable();
            $table->decimal('youth', 8, 2)->nullable();
            $table->decimal('animalwel', 8, 2)->nullable();
            $table->decimal('coalanwel', 8, 2)->nullable();
            $table->decimal('sum_human', 8, 2)->nullable();
            $table->decimal('stand_human', 8, 2)->nullable();

            $table->decimal('mkt_local', 8, 2)->nullable();
            $table->decimal('networks', 8, 2)->nullable();
            $table->decimal('local_fs', 8, 2)->nullable();
            $table->decimal('sum_circular', 8, 2)->nullable();
            $table->decimal('stand_circular', 8, 2)->nullable();

            $table->decimal('prod_empow', 8, 2)->nullable();
            $table->decimal('prod_orgs', 8, 2)->nullable();
            $table->decimal('partic_prod', 8, 2)->nullable();
            $table->decimal('sum_respgov', 8, 2)->nullable();
            $table->decimal('stand_respgov', 8, 2)->nullable();

            $table->decimal('totscore_caet', 8, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caets');
    }
};
