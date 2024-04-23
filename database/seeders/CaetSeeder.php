<?php

namespace Database\Seeders;

use App\Models\CaetElement;
use Illuminate\Database\Seeder;

class CaetSeeder extends Seeder
{
    public function run()
    {
        $diversity = CaetElement::create(['name' => "Diversity"]);
        $synergies = CaetElement::create(['name' => "Synergies"]);
        $recycling = CaetElement::create(['name' => "Recycling"]);
        $efficiency = CaetElement::create(['name' => "Efficiency"]);
        $resilience = CaetElement::create(['name' => "Resilience"]);
        $culture = CaetElement::create(['name' => "Culture & Food Tradition"]);
        $coCreation = CaetElement::create(['name' => "Co-creation & Sharing of Knowledge"]);
        $human = CaetElement::create(['name' => "Human & Social Values"]);
        $circular = CaetElement::create(['name' => "Circular & Solidarity Economy"]);
        $responsableGov = CaetElement::create(['name' => "Responsible Governance"]);

        $diversity->caetIndices()->createMany([
            [
                'name' => 'Crops',
                'xlsform_name' => 'crops',
            ],
            [
                'name' => 'Animals (including fish and insects)',
                'xlsform_name' => 'animals',
            ],
            [
                'name' => 'Trees (and other perennials)',
                'xlsform_name' => 'trees',
            ],
            [
                'name' => 'Diversity of economic activities, products and services',
                'xlsform_name' => 'div_activ',
            ],
        ]);

        $synergies->caetIndices()->createMany([
            [
                'name' => 'Crop-livestock integration',
                'xlsform_name' => 'cla_int'
            ],
            [
                'name' => 'Soil-plants system management',
                'xlsform_name' => 's_plant'
            ],
            [
                'name' => 'Integration with trees (agroforestry, silvopastoralism, agrosilvopastoralism)',
                'xlsform_name' => 'tree_int'
            ],
            [
                'name' => 'Connectivity between elements of the agroecosystem and the landscape',
                'xlsform_name' => 'connectivity'
            ],
        ]);

        $recycling->caetIndices()->createMany([
            [
                'name' => 'Recycling of biomass and nutrients',
                'xlsform_name' => 'rec_biomass',
            ],
            [
                'name' => 'Waste production and management',
                'xlsform_name' => 'waste',
            ],
            [
                'name' => 'Water recycling and saving',
                'xlsform_name' => 'water',
            ],
            [
                'name' => 'Energy reduction and renewable energy',
                'xlsform_name' => 'ren_energy',
            ],
        ]);

        $efficiency->caetIndices()->createMany([
            [
                'name' => 'Use of external inputs',
                'xlsform_name' => 'ext_inp',
            ],
            [
                'name' => 'Management of soil fertility',
                'xlsform_name' => 'soil_fert',
            ],
            [
                'name' => 'Management of pests & diseases',
                'xlsform_name' => 'pest_dis',
            ],
        ]);

        $resilience->caetIndices()->createMany([
            [
                'name' => 'Existence of social mechanisms to reduce vulnerability',
                'xlsform_name' => 'vuln',
            ],
            [
                'name' => 'Environmental resilience and capacity to adapt to climate change',
                'xlsform_name' => 'indebt',
            ],
        ]);

        $culture->caetIndices()->createMany([
            [
                'name' => 'Appropriate diet and nutrition awareness',
                'xlsform_name' => 'diet',
            ],
            [
                'name' => 'Food self-sufficiency',
                'xlsform_name' => 'food-self-suff',
            ],
            [
                'name' => 'Local and traditional food heritage',
                'xlsform_name' => 'food-heritage',
            ],
            [
                'name' => 'Management of seeds and breeds',
                'xlsform_name' => 'seeds_breeds',
            ],
        ]);

        $coCreation->caetIndices()->createMany([
            ['name' => 'Access to agroecological knowledge and interest of producers in agroecology',
                'xlsform_name' => 'ae_know',
            ],
            [
                'name' => 'Social mechanisms for the horizontal creation and transfer of knowledge and good practices',
                'xlsform_name' => 'platforms',
            ],
            [
                'name' => 'Participation of producers in networks and grassroot organizations',
                'xlsform_name' => 'partic_orgs',
            ],
        ]);

        $human->caetIndices()->createMany([
            [
                'name' => "Women's empowerment",
                'xlsform_name' => 'women',
            ],
            [
                'name' => 'Labour (productive conditions, social inequalities)',
                'xlsform_name' => 'labour',
            ],
            [
                'name' => 'Motivation in agricultural work and continuity of family farming',
                'xlsform_name' => 'youth',
            ],
            [
                'name' => 'Animal welfare [if applicable]',
                'xlsform_name' => 'animalwel',
            ],
        ]);

        $circular->caetIndices()->createMany([
            [
                'name' => 'Products and services marketed locally (or with fair trade)',
                'xlsform_name' => 'mkt_local',
            ],
            [
                'name' => 'Networks of producers, relationship with consumers and presence of intermediaries',
                'xlsform_name' => 'networks',
            ],
            [
                'name' => 'Local sourcing and circularity',
                'xlsform_name' => 'local_fs',
            ],
        ]);

        $responsableGov->caetIndices()->createMany([
            [
                'name' => "Producers' empowerment",
                'xlsform_name' => 'prod_empow'
            ],
            [
                'name' => "Producers' organizations and associations",
                'xlsform_name' => 'prod_orgs',
            ],
            [
                'name' => "Inclusive decision-making processes",
                'xlsform_name' => 'partic_prod',
            ],
        ]);


        $this->call(CaetScaleSeeder::class);


    }

}
