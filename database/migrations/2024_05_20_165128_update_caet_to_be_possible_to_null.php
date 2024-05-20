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
        Schema::table('null', function (Blueprint $table) {
            Schema::table('main_surveys', function (Blueprint $table) {
            $table->decimal('totscore_caet1', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('totscore_caet', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('stand_respgov', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('sum_respgov', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('partic_prod', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('prod_orgs', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('prod_empow', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('stand_circular', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('sum_circular', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('local_fs', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('networks', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('mkt_local', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('stand_human1', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('sum_human1', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('stand_human', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('sum_human', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('coalanwel', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('animalwel', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('youth', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('labour', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('women', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('stand_cocrea', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('sum_cocrea', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('partic_orgs', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('platforms', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('ae_know', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('stand_cultfood', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('sum_cultfood', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('seeds_breeds', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('food-heritage', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('food-self-suff', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('diet', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('stand_res', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('sum_res', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('averself-suff-empowerment', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('averdiv', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('indebt', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('vuln', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('stand_eff', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('sum_eff', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('emergingefficiency', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('pest_dis', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('soil_fert', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('ext_inp', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('stand_rec', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('sum_rec', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('ren_energy', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('water', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('waste', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('rec_biomass', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('stand_syn', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('sum_syn', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('connectivity', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('tree_int', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('s_plant', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('cla_int', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('stand_diversity', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('sum_diversity', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('div_activ', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('trees', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('animals', 5, 2)->after('outoth')->nullable()->change();
            $table->decimal('crops', 5, 2)->after('outoth')->nullable()->change();
        });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('null', function (Blueprint $table) {
            //
        });
    }
};
