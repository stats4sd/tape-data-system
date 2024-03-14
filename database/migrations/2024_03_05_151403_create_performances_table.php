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
        Schema::create('performances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farm_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('assessment_date')->nullable();


            // Might put these into a json properties column...
            $table->integer('area_unit')->nullable();
            $table->string('currency')->nullable();
            $table->integer('otcurr')->nullable();
            $table->integer('recland_men')->nullable();
            $table->integer('recland_women')->nullable();
            $table->integer('doc_men')->nullable();
            $table->string('doc_menoth')->nullable();
            $table->integer('doc_women')->nullable();
            $table->string('doc_womenoth')->nullable();
            $table->integer('name_men')->nullable();
            $table->integer('name_women')->nullable();
            $table->integer('ltperc_men')->nullable();
            $table->integer('ltperc_women')->nullable();
            $table->integer('sell_men')->nullable();
            $table->integer('sell_women')->nullable();
            $table->integer('beq_men')->nullable();
            $table->integer('beq_women')->nullable();
            $table->integer('inh_men')->nullable();
            $table->integer('inh_women')->nullable();
            $table->text('cropsnum')->nullable();
            $table->text('cfpnum')->nullable();
            $table->integer('nat_veg')->nullable();
            $table->integer('bee')->nullable();
            $table->integer('poll')->nullable();
            $table->integer('raise_animals')->nullable();
            $table->text('animnum')->nullable();
            $table->integer('past')->nullable();
            $table->text('anprodnum')->nullable();
            $table->integer('activnum')->nullable();
            $table->decimal('foodexp', 20, 2)->nullable();
            $table->decimal('seedsexp', 20, 2)->nullable();
            $table->decimal('fertexp', 20, 2)->nullable();
            $table->decimal('livexp', 20, 2)->nullable();
            $table->integer('if_extworkers')->nullable();
            $table->integer('if_extworkers_year')->nullable();
            $table->integer('num_extworkers_year')->nullable();
            $table->integer('wage_year')->nullable();
            $table->integer('if_extworkers_season')->nullable();
            $table->integer('num_extworkers_season')->nullable();
            $table->decimal('days_ext', 20, 2)->nullable();
            $table->integer('wage_season')->nullable();
            $table->decimal('machexp')->nullable();
            $table->integer('machnum')->nullable();
            $table->decimal('fuelexp', 20, 2)->nullable();
            $table->decimal('enerexp', 20, 2)->nullable();
            $table->decimal('machrentexp', 20, 2)->nullable();
            $table->decimal('transpexp', 20, 2)->nullable();
            $table->decimal('rentcost', 20, 2)->nullable();
            $table->text('essential_rev')->nullable();
            $table->text('aname_other')->nullable();
            $table->integer('dest')->nullable();
            $table->integer('inc3')->nullable();
            $table->integer('stabincome')->nullable();
            $table->integer('livcon')->nullable();
            $table->integer('envfuture')->nullable();
            $table->integer('cpestnum')->nullable();
            $table->decimal('cp_exp', 20, 2)->nullable();
            $table->integer('opestnum')->nullable();
            $table->decimal('op_exp', 20, 2)->nullable();
            $table->text('mitig')->nullable();
            $table->text('mitother')->nullable();
            $table->text('ecoman')->nullable();
            $table->text('ecomanother')->nullable();
            $table->integer('pestimpo')->nullable();
            $table->integer('orgpestimpo')->nullable();
            $table->integer('mitigimpo')->nullable();
            $table->integer('cpestimpact')->nullable();
            $table->integer('ecomanimpo')->nullable();
            $table->integer('cpestfuture')->nullable();
            $table->integer('y_emigmembers')->nullable();
            $table->integer('answom')->nullable();
            $table->integer('manref')->nullable();
            $table->integer('edulev_men')->nullable();
            $table->integer('edulev_women')->nullable();
            $table->integer('wtime_ag_men')->nullable();
            $table->integer('wtime_ag_women')->nullable();
            $table->integer('wtime_dom_men')->nullable();
            $table->integer('wtime_dom_women')->nullable();
            $table->integer('wtime_otgain_men')->nullable();
            $table->integer('wtime_otgain_women')->nullable();
            $table->integer('owcrop')->nullable();
            $table->integer('owanim')->nullable();
            $table->integer('owhouse')->nullable();
            $table->integer('owotact')->nullable();
            $table->integer('deccrop')->nullable();
            $table->integer('decmajor')->nullable();
            $table->integer('decanim')->nullable();
            $table->integer('decotact')->nullable();
            $table->integer('dec_rev_crop')->nullable();
            $table->integer('dec_rev_anim')->nullable();
            $table->text('dec_rev_oth')->nullable();
            $table->integer('credit_men')->nullable();
            $table->integer('credit_women')->nullable();
            $table->integer('involv_agri_men')->nullable();
            $table->integer('involv_agri_wom')->nullable();
            $table->integer('involv_othe_men')->nullable();
            $table->integer('involv_othe_wom')->nullable();
            $table->integer('worried')->nullable();
            $table->integer('healthy')->nullable();
            $table->integer('fewfoods')->nullable();
            $table->integer('skipped')->nullable();
            $table->integer('ateless')->nullable();
            $table->integer('ranout')->nullable();
            $table->integer('hungry')->nullable();
            $table->integer('wholeday')->nullable();
            $table->integer('grains_a')->nullable();
            $table->integer('grains_b')->nullable();
            $table->integer('pulses')->nullable();
            $table->integer('nuts')->nullable();
            $table->integer('dairy_e')->nullable();
            $table->integer('dairy_f')->nullable();
            $table->integer('meat_h')->nullable();
            $table->integer('meat_i')->nullable();
            $table->integer('meat_j')->nullable();
            $table->integer('meat_k')->nullable();
            $table->integer('meat_l')->nullable();
            $table->integer('eggs')->nullable();
            $table->integer('darkgreen')->nullable();
            $table->integer('darkyellow_n')->nullable();
            $table->integer('otherveg')->nullable();
            $table->integer('darkyellow_o')->nullable();
            $table->integer('otherfruit')->nullable();
            $table->integer('fried_salty_1')->nullable();
            $table->integer('fried_salty_2')->nullable();
            $table->integer('fried_salty_3')->nullable();
            $table->integer('fried_salty_4')->nullable();
            $table->integer('sweet_foods')->nullable();
            $table->integer('sweet_beverages_1')->nullable();
            $table->integer('sweet_beverages_2')->nullable();
            $table->integer('structure')->nullable();
            $table->integer('compaction')->nullable();
            $table->integer('depth')->nullable();
            $table->integer('residues')->nullable();
            $table->integer('color')->nullable();
            $table->integer('water_ret')->nullable();
            $table->integer('cover')->nullable();
            $table->integer('erosion')->nullable();
            $table->integer('invertebrates')->nullable();
            $table->integer('microbio')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performances');
    }
};
