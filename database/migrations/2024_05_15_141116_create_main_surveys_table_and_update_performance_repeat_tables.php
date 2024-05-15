<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('main_surveys', function (Blueprint $table) {
            $table->id();

            $table->text('start')->nullable();
            $table->text('end')->nullable();
            $table->text('today')->nullable();
            $table->text('deviceid')->nullable();
            $table->text('inquirer')->nullable();
            $table->foreignId('final_location_id')->nullable();
            $table->foreignId('farm_id')->nullable();
            $table->text('respondent_available')->nullable();
            $table->text('non_beneficiary_screening')->nullable();
            $table->text('consent')->nullable();
            $table->text('respondent_name')->nullable();
            $table->text('respondent_phone')->nullable();
            $table->text('gps_loc')->nullable(); // split this?
            $table->integer('hh_men')->nullable();
            $table->integer('hh_women')->nullable();
            $table->integer('hh_myoung')->nullable();
            $table->integer('hh_fyoung')->nullable();
            $table->integer('hh_children')->nullable();
            $table->decimal('ag_men', 20, 2)->nullable();
            $table->decimal('ag_women', 20, 2)->nullable();
            $table->decimal('ag_myoung', 20, 2)->nullable();
            $table->decimal('ag_fyoung', 20, 2)->nullable();
            $table->decimal('ag_children', 20, 2)->nullable();
            $table->text('area_unit')->nullable();
            $table->decimal('area', 20, 2)->nullable();
            $table->decimal('area_ha', 20, 2)->nullable();
            $table->decimal('area_natural_veg', 20, 2)->nullable();
            $table->decimal('area_natural_veg_ha', 20, 2)->nullable();
            $table->decimal('area_permanent_pasture', 20, 2)->nullable();
            $table->decimal('area_permanent_pasture_ha', 20, 2)->nullable();
            $table->decimal('area_common_pasture', 20, 2)->nullable();
            $table->decimal('area_common_pasture_ha', 20, 2)->nullable();
            $table->text('prod_output')->nullable();
            $table->text('outoth')->nullable();
            $table->text('currency')->nullable();
            $table->text('otcurr')->nullable();
            $table->text('recland_men')->nullable();
            $table->text('recland_women')->nullable();
            $table->text('doc_men')->nullable();
            $table->text('doc_menoth')->nullable();
            $table->text('doc_women')->nullable();
            $table->text('doc_womenoth')->nullable();
            $table->text('name_men')->nullable();
            $table->text('name_women')->nullable();
            $table->text('ltperc_men')->nullable();
            $table->text('ltperc_women')->nullable();
            $table->text('sell_men')->nullable();
            $table->text('sell_women')->nullable();
            $table->text('beq_men')->nullable();
            $table->text('beq_women')->nullable();
            $table->text('inh_men')->nullable();
            $table->text('inh_women')->nullable();
            $table->text('cropsnum')->nullable();
            $table->text('cfpnum')->nullable();

            $table->text('nat_veg')->nullable();
            $table->text('bee')->nullable();
            $table->text('poll')->nullable();
            $table->text('raise_animals')->nullable();
            $table->text('animnum')->nullable();

            $table->text('past')->nullable();
            $table->decimal('feedexp_total', 20, 2)->nullable();
            $table->decimal('vetexp_total', 20, 2)->nullable();

            $table->text('anprodnum')->nullable();

            $table->integer('activnum')->nullable();

            $table->decimal('foodexp', 20, 2)->nullable();
            $table->decimal('seedsexp', 20, 2)->nullable();
            $table->decimal('fertexp', 20, 2)->nullable();
            $table->decimal('livexp', 20, 2)->nullable();
            $table->text('if_extworkers')->nullable();
            $table->text('if_extworkers_year')->nullable();
            $table->integer('num_extworkers_year')->nullable();
            $table->integer('wage_year')->nullable();
            $table->text('if_extworkers_season')->nullable();
            $table->integer('num_extworkers_season')->nullable();
            $table->decimal('days_ext', 20, 2)->nullable();
            $table->integer('wage_season')->nullable();
            $table->integer('machnum')->nullable();
            $table->decimal('machexp', 20, 2)->nullable();

            $table->decimal('fuelexp', 20, 2)->nullable();
            $table->decimal('enerexp', 20, 2)->nullable();
            $table->decimal('machrentexp', 20, 2)->nullable();
            $table->decimal('transpexp', 20, 2)->nullable();
            $table->decimal('rentcost', 20, 2)->nullable();
            $table->text('essential_rev')->nullable();
            $table->text('essential_rev_other')->nullable();
            $table->text('dest')->nullable();
            $table->text('inc3')->nullable();
            $table->text('stabincome')->nullable();
            $table->text('livcon')->nullable();
            $table->text('envfuture')->nullable();
            $table->integer('cpestnum')->nullable();

            $table->decimal('cp_exp', 20, 2)->nullable();
            $table->integer('opestnum')->nullable();


            $table->decimal('op_exp', 20, 2)->nullable();
            $table->text('mitig')->nullable();
            $table->text('mitother')->nullable();
            $table->text('ecoman')->nullable();
            $table->text('ecomanother')->nullable();
            $table->text('pestimpo')->nullable();
            $table->text('orgpestimpo')->nullable();
            $table->text('mitigimpo')->nullable();
            $table->text('cpestimpact')->nullable();
            $table->text('ecomanimpo')->nullable();
            $table->text('cpestfuture')->nullable();

            $table->integer('y_emigmembers')->nullable();

            $table->text('yeswomenhh')->nullable();
            $table->text('answom')->nullable();
            $table->text('manref')->nullable();
            $table->text('edulev_men')->nullable();
            $table->text('edulev_women')->nullable();
            $table->integer('wtime_ag_men')->nullable();
            $table->integer('wtime_ag_women')->nullable();
            $table->integer('wtime_dom_men')->nullable();
            $table->integer('wtime_dom_women')->nullable();
            $table->integer('wtime_otgain_men')->nullable();
            $table->integer('wtime_otgain_women')->nullable();
            $table->text('owcrop')->nullable();
            $table->text('owanim')->nullable();
            $table->text('owhouse')->nullable();
            $table->text('owotact')->nullable();
            $table->text('deccrop')->nullable();
            $table->text('decmajor')->nullable();
            $table->text('decanim')->nullable();
            $table->text('decotact')->nullable();
            $table->text('dec_rev_crop')->nullable();
            $table->text('dec_rev_anim')->nullable();
            $table->text('dec_rev_oth')->nullable();
            $table->text('credit_men')->nullable();
            $table->text('credit_women')->nullable();
            $table->text('involv_agri_men')->nullable();
            $table->text('involv_agri_wom')->nullable();
            $table->text('involv_othe_men')->nullable();
            $table->text('involv_othe_wom')->nullable();
            $table->text('WORRIED')->nullable();
            $table->text('HEALTHY')->nullable();
            $table->text('FEWFOODS')->nullable();
            $table->text('SKIPPED')->nullable();
            $table->text('ATELESS')->nullable();
            $table->text('RANOUT')->nullable();
            $table->text('HUNGRY')->nullable();
            $table->text('WHOLEDAY')->nullable();
            $table->text('grains_A')->nullable();
            $table->text('grains_B')->nullable();
            $table->text('pulses')->nullable();
            $table->text('nuts')->nullable();
            $table->text('dairy_E')->nullable();
            $table->text('dairy_F')->nullable();
            $table->text('meat_H')->nullable();
            $table->text('meat_I')->nullable();
            $table->text('meat_J')->nullable();
            $table->text('meat_K')->nullable();
            $table->text('meat_L')->nullable();
            $table->text('eggs')->nullable();
            $table->text('darkgreen')->nullable();
            $table->text('darkyellow_N')->nullable();
            $table->text('otherveg')->nullable();
            $table->text('darkyellow_O')->nullable();
            $table->text('otherfruit')->nullable();
            $table->text('fried_salty_1')->nullable();
            $table->text('fried_salty_2')->nullable();
            $table->text('fried_salty_3')->nullable();
            $table->text('fried_salty_4')->nullable();
            $table->text('sweet_foods')->nullable();
            $table->text('sweet_beverages_1')->nullable();
            $table->text('sweet_beverages_2')->nullable();
            $table->text('structure')->nullable();
            $table->text('compaction')->nullable();
            $table->text('depth')->nullable();
            $table->text('residues')->nullable();
            $table->text('color')->nullable();
            $table->text('water_ret')->nullable();
            $table->text('cover')->nullable();
            $table->text('erosion')->nullable();
            $table->text('invertebrates')->nullable();
            $table->text('microbio')->nullable();
            $table->text('crops')->nullable();
            $table->text('animals')->nullable();
            $table->text('trees')->nullable();
            $table->text('div_activ')->nullable();
            $table->decimal('sum_diversity', 20, 2)->nullable();
            $table->decimal('stand_diversity', 20, 2)->nullable();
            $table->text('cla_int')->nullable();
            $table->text('s_plant')->nullable();
            $table->text('tree_int')->nullable();
            $table->text('connectivity')->nullable();
            $table->decimal('sum_syn', 20, 2)->nullable();
            $table->decimal('stand_syn', 20, 2)->nullable();
            $table->text('rec_biomass')->nullable();
            $table->text('waste')->nullable();
            $table->text('water')->nullable();
            $table->text('ren_energy')->nullable();
            $table->decimal('sum_rec', 20, 2)->nullable();
            $table->decimal('stand_rec', 20, 2)->nullable();
            $table->text('ext_inp')->nullable();
            $table->text('soil_fert')->nullable();
            $table->text('pest_dis')->nullable();
            $table->decimal('emergingefficiency', 20, 2)->nullable();
            $table->decimal('sum_eff', 20, 2)->nullable();
            $table->decimal('stand_eff', 20, 2)->nullable();
            $table->text('vuln')->nullable();
            $table->text('indebt')->nullable();
            $table->decimal('averdiv', 20, 2)->nullable();
            $table->decimal('averself-, 20, 2suff-empowerment')->nullable();
            $table->decimal('sum_res', 20, 2)->nullable();
            $table->decimal('stand_res', 20, 2)->nullable();
            $table->text('diet')->nullable();
            $table->text('food-self-suff')->nullable();
            $table->text('food-heritage')->nullable();
            $table->text('seeds_breeds')->nullable();
            $table->decimal('sum_cultfood', 20, 2)->nullable();
            $table->decimal('stand_cultfood', 20, 2)->nullable();
            $table->text('ae_know')->nullable();
            $table->text('platforms')->nullable();
            $table->text('partic_orgs')->nullable();
            $table->decimal('sum_cocrea', 20, 2)->nullable();
            $table->decimal('stand_cocrea', 20, 2)->nullable();
            $table->text('women')->nullable();
            $table->text('labour')->nullable();
            $table->text('youth')->nullable();
            $table->text('animalwel')->nullable();
            $table->decimal('coalanwel', 20, 2)->nullable();
            $table->decimal('sum_human', 20, 2)->nullable();
            $table->decimal('stand_human', 20, 2)->nullable();
            $table->decimal('sum_human1', 20, 2)->nullable();
            $table->decimal('stand_human1', 20, 2)->nullable();
            $table->text('mkt_local')->nullable();
            $table->text('networks')->nullable();
            $table->text('local_fs')->nullable();
            $table->decimal('sum_circular', 20, 2)->nullable();
            $table->decimal('stand_circular', 20, 2)->nullable();
            $table->text('prod_empow')->nullable();
            $table->text('prod_orgs')->nullable();
            $table->text('partic_prod')->nullable();
            $table->decimal('sum_respgov', 20, 2)->nullable();
            $table->decimal('stand_respgov', 20, 2)->nullable();
            $table->decimal('totscore_caet', 20, 2)->nullable();
            $table->decimal('totscore_caet1', 20, 2)->nullable();
            $table->text('notes_text')->nullable();
            $table->text('notes_photo')->nullable();
            $table->timestamps();
        });


        Schema::table('performance_crop_products', function (Blueprint $table) {
            $table->dropColumn('cfpname_other');
        });

        Schema::table('performance_animal_products', function (Blueprint $table) {
            $table->dropColumn('apname_other')->nullable();
        });

        Schema::table('performance_chemical_pesticides', function (Blueprint $table) {
            $table->text('cp_unit')->nullable();
            $table->dropColumn('cpused');
        });

        Schema::table('performance_organic_pesticides', function (Blueprint $table) {
            $table->text('cocrop')->nullable();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_surveys');
    }
};
