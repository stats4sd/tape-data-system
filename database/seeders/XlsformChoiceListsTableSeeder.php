<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class XlsformChoiceListsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        DB::table('xlsform_choice_lists')->delete();
        DB::table('xlsform_choice_lists')->insert([
                [
                    'list_name' => '',
                    'label' => '',
                ],
                [
                    'list_name' => 'activities',
                    'label' => '',
                ],
                [
                    'list_name' => 'animal_products_ext',
                    'label' => '',
                ],
                [
                    'list_name' => 'animals_ext',
                    'label' => '',
                ],
                [
                    'list_name' => 'area_units_ext',
                    'label' => 'Area Units',
                ],
                [
                    'list_name' => 'beekeeping',
                    'label' => 'Beekeeping',
                ],
                [
                    'list_name' => 'caet_activity_diversity',
                    'label' => ' CAET Activity Diversity Rubric',
                ],
                [
                    'list_name' => 'caet_ae_knowledge',
                    'label' => ' CAET AE Knowledge Rubric',
                ],
                [
                    'list_name' => 'caet_animal_diversity',
                    'label' => ' CAET Animal Diversity Rubric',
                ],
                [
                    'list_name' => 'caet_animal_welfare',
                    'label' => ' CAET Animal Welfare Rubric',
                ],
                [
                    'list_name' => 'caet_connectivity',
                    'label' => ' CAET Connectivity Rubric',
                ],
                [
                    'list_name' => 'caet_crop_diversity',
                    'label' => ' CAET Crop Diversity Rubric',
                ],
                [
                    'list_name' => 'caet_crop_livestock_integration',
                    'label' => ' CAET Crop Livestock Integration Rubric',
                ],
                [
                    'list_name' => 'caet_diet',
                    'label' => ' CAET Diet Rubric',
                ],
                [
                    'list_name' => 'caet_energy_reduction',
                    'label' => ' CAET Energy Reduction Rubric',
                ],
                [
                    'list_name' => 'caet_external_inputs',
                    'label' => ' CAET External Inputs Rubric',
                ],
                [
                    'list_name' => 'caet_food_heritage',
                    'label' => ' CAET Food Heritage Rubric',
                ],
                [
                    'list_name' => 'caet_food_self_sufficiency',
                    'label' => ' CAET Food Self Sufficiency Rubric',
                ],
                [
                    'list_name' => 'caet_inclusive_decisions',
                    'label' => ' CAET Inclusive Decisions Rubric',
                ],
                [
                    'list_name' => 'caet_labour',
                    'label' => ' CAET Labour Rubric',
                ],
                [
                    'list_name' => 'caet_local_fs',
                    'label' => ' CAET Local FS Rubric',
                ],
                [
                    'list_name' => 'caet_market_local',
                    'label' => ' CAET Market Local Rubric',
                ],
                [
                    'list_name' => 'caet_participation_orgs',
                    'label' => ' CAET Participation',
                ],
                [
                    'list_name' => 'caet_pest_diseases',
                    'label' => ' CAET Pest Diseases Rubric',
                ],
                [
                    'list_name' => 'caet_producer_empowerment',
                    'label' => ' CAET Producer Empowerment Rubric',
                ],
                [
                    'list_name' => 'caet_producer_networks',
                    'label' => ' CAET Producer Networks Rubric',
                ],
                [
                    'list_name' => 'caet_producer_organisations',
                    'label' => ' CAET Producer Organisations Rubric',
                ],
                [
                    'list_name' => 'caet_recycling_biomass',
                    'label' => ' CAET Recycling Biomass Rubric',
                ],
                [
                    'list_name' => 'caet_resiliance',
                    'label' => ' CAET Resiliance Rubric',
                ],
                [
                    'list_name' => 'caet_seeds_breeds',
                    'label' => ' CAET Seeds Breeds Rubric',
                ],
                [
                    'list_name' => 'caet_social_platforms',
                    'label' => ' CAET Social Platforms Rubric',
                ],
                [
                    'list_name' => 'caet_soil_fertility',
                    'label' => ' CAET Soil Fertility Rubric',
                ],
                [
                    'list_name' => 'caet_soil_management',
                    'label' => ' CAET Soil Management Rubric',
                ],
                [
                    'list_name' => 'caet_tree_diversity',
                    'label' => ' CAET Tree Diversity Rubric',
                ],
                [
                    'list_name' => 'caet_tree_integration',
                    'label' => ' CAET Tree Integration Rubric',
                ],
                [
                    'list_name' => 'caet_vulnerability',
                    'label' => ' CAET Vulnerability Rubric',
                ],
                [
                    'list_name' => 'caet_waste_management',
                    'label' => ' CAET Waste Management Rubric',
                ],
                [
                    'list_name' => 'caet_water_recycling',
                    'label' => ' CAET Water Recycling Rubric',
                ],
                [
                    'list_name' => 'caet_women',
                    'label' => ' CAET Women Rubric',
                ],
                [
                    'list_name' => 'caet_youth',
                    'label' => ' CAET Youth Rubric',
                ],
                [
                    'list_name' => 'comparison',
                    'label' => '',
                ],
                [
                    'list_name' => 'cpesticides_future',
                    'label' => '',
                ],
                [
                    'list_name' => 'credit',
                    'label' => '',
                ],
                [
                    'list_name' => 'crop_forestry_products_ext',
                    'label' => 'Crop  + Forestry products (Custom per team)',
                ],
                [
                    'list_name' => 'crops_ext',
                    'label' => 'Crops (Custom per team)',
                ],
                [
                    'list_name' => 'currencies',
                    'label' => 'Currencies',
                ],
                [
                    'list_name' => 'dietyn',
                    'label' => '',
                ],
                [
                    'list_name' => 'docs',
                    'label' => 'Land Tenure Documents',
                ],
                [
                    'list_name' => 'eco_management_methods',
                    'label' => '',
                ],
                [
                    'list_name' => 'education_levels',
                    'label' => '',
                ],
                [
                    'list_name' => 'enumerators_ext',
                    'label' => 'Enumerators (custom per team)',
                ],
                [
                    'list_name' => 'envision_future',
                    'label' => '',
                ],
                [
                    'list_name' => 'farms_ext',
                    'label' => 'Farms (custom per team)',
                ],
                [
                    'list_name' => 'farms_ext_reserve',
                    'label' => 'Farms in Reserve (not main sample)',
                ],
                [
                    'list_name' => 'gender_decision_making',
                    'label' => '',
                ],
                [
                    'list_name' => 'genders',
                    'label' => 'Genders',
                ],
                [
                    'list_name' => 'important',
                    'label' => 'Important',
                ],
                [
                    'list_name' => 'income_compare',
                    'label' => '',
                ],
                [
                    'list_name' => 'involvement_in_orgs',
                    'label' => '',
                ],
                [
                    'list_name' => 'level_fies',
                    'label' => '',
                ],
                [
                    'list_name' => 'list_name',
                    'label' => '',
                ],
                [
                    'list_name' => 'locations_ext',
                    'label' => 'Locations (custom per team)',
                ],
                [
                    'list_name' => 'mitigation_strategies',
                    'label' => '',
                ],
                [
                    'list_name' => 'natural_vegitation',
                    'label' => 'Natural Vegitation',
                ],
                [
                    'list_name' => 'occupations',
                    'label' => '',
                ],
                [
                    'list_name' => 'outputs',
                    'label' => 'Farm Outputs',
                ],
                [
                    'list_name' => 'pasture',
                    'label' => '',
                ],
                [
                    'list_name' => 'pesticide_units',
                    'label' => '',
                ],
                [
                    'list_name' => 'pollinators',
                    'label' => 'Polinators',
                ],
                [
                    'list_name' => 'positive_negative',
                    'label' => 'Positive-to-Negative scale',
                ],
                [
                    'list_name' => 'product_destinations',
                    'label' => '',
                ],
                [
                    'list_name' => 'product_units',
                    'label' => 'Unit of measure for Crop Products',
                ],
                [
                    'list_name' => 'self_or_purchased',
                    'label' => '',
                ],
                [
                    'list_name' => 'soil_color',
                    'label' => '',
                ],
                [
                    'list_name' => 'soil_compaction',
                    'label' => '',
                ],
                [
                    'list_name' => 'soil_cover',
                    'label' => '',
                ],
                [
                    'list_name' => 'soil_depth',
                    'label' => '',
                ],
                [
                    'list_name' => 'soil_erosion',
                    'label' => '',
                ],
                [
                    'list_name' => 'soil_invertebrates',
                    'label' => '',
                ],
                [
                    'list_name' => 'soil_microbio',
                    'label' => '',
                ],
                [
                    'list_name' => 'soil_residues',
                    'label' => '',
                ],
                [
                    'list_name' => 'soil_structure',
                    'label' => '',
                ],
                [
                    'list_name' => 'soil_water_ret',
                    'label' => '',
                ],
                [
                    'list_name' => 'sources',
                    'label' => '',
                ],
                [
                    'list_name' => 'stable_income',
                    'label' => '',
                ],
                [
                    'list_name' => 'toxicity',
                    'label' => '',
                ],
                [
                    'list_name' => 'weight_units_ext',
                    'label' => 'Weight Units (custom per team)',
                ],
                [
                    'list_name' => 'y_emig_return',
                    'label' => '',
                ],
                [
                    'list_name' => 'y_emig_where',
                    'label' => '',
                ],
                [
                    'list_name' => 'y_emig_why',
                    'label' => '',
                ],
                [
                    'list_name' => 'yn',
                    'label' => 'Yes/No',
                ],
                [
                    'list_name' => 'yn_na',
                    'label' => 'Yes/No/Na',
                ],
                [
                    'list_name' => 'yn_noref',
                    'label' => 'Yes/No without refusal',
                ],
        ]);


    }
}
