<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class XlsformChoicesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('xlsform_choices')->delete();

        DB::table('xlsform_choices')->insert([
            [
                'list_name' => 'yn',
                'name' => '1',
                'label' => 'Yes',
            ],
            [
                'list_name' => 'yn',
                'name' => '0',
                'label' => 'No',
            ],
            [
                'list_name' => 'yn',
                'name' => '-99',
                'label' => 'Don\'t know / Refused to answer',
            ],
            [
                'list_name' => 'yn_noref',
                'name' => '1',
                'label' => 'Yes',
            ],
            [
                'list_name' => 'yn_noref',
                'name' => '0',
                'label' => 'No',
            ],
            [
                'list_name' => 'yn_na',
                'name' => '1',
                'label' => 'Yes',
            ],
            [
                'list_name' => 'yn_na',
                'name' => '0',
                'label' => 'No',
            ],
            [
                'list_name' => 'yn_na',
                'name' => '-99',
                'label' => 'Don\'t know / Refused to answer',
            ],
            [
                'list_name' => 'yn_na',
                'name' => '-98',
                'label' => 'NA ',
            ],
            [
                'list_name' => 'currencies',
                'name' => 'USD',
                'label' => 'USD-United States dollar',
            ],
            [
                'list_name' => 'currencies',
                'name' => 'EUR',
                'label' => 'EUR-Euro',
            ],
            [
                'list_name' => 'currencies',
                'name' => 'ETB',
                'label' => 'ETB-Ethiopian birr',
            ],
            [
                'list_name' => 'currencies',
                'name' => 'KES',
                'label' => 'KES-Kenyan shilling',
            ],
            [
                'list_name' => 'currencies',
                'name' => 'MGA',
                'label' => 'MGA-Malagasy ariary',
            ],
            [
                'list_name' => 'currencies',
                'name' => 'XOF',
                'label' => 'XOF - West African Franc',
            ],
            [
                'list_name' => 'currencies',
                'name' => '77',
            'label' => 'Other (specify)',
            ],
            [
                'list_name' => 'important',
                'name' => '1',
                'label' => 'Irrelevant',
            ],
            [
                'list_name' => 'important',
                'name' => '2',
                'label' => 'Not very important',
            ],
            [
                'list_name' => 'important',
                'name' => '3',
                'label' => 'Neutral',
            ],
            [
                'list_name' => 'important',
                'name' => '4',
                'label' => 'Important',
            ],
            [
                'list_name' => 'important',
                'name' => '5',
                'label' => 'Very important',
            ],
            [
                'list_name' => 'positive_negative',
                'name' => '5',
                'label' => 'Mostly positive',
            ],
            [
                'list_name' => 'positive_negative',
                'name' => '4',
                'label' => 'Positive',
            ],
            [
                'list_name' => 'positive_negative',
                'name' => '3',
                'label' => 'Neutral',
            ],
            [
                'list_name' => 'positive_negative',
                'name' => '2',
                'label' => 'Negative',
            ],
            [
                'list_name' => 'positive_negative',
                'name' => '1',
                'label' => 'Mostly negative',
            ],
            [
                'list_name' => 'genders',
                'name' => '1',
                'label' => 'Male',
            ],
            [
                'list_name' => 'genders',
                'name' => '2',
                'label' => 'Female',
            ],
            [
                'list_name' => 'outputs',
                'name' => '1',
                'label' => 'Crops and crop products',
            ],
            [
                'list_name' => 'outputs',
                'name' => '2',
            'label' => 'Animals (including fish) and animal products',
            ],
            [
                'list_name' => 'outputs',
                'name' => '3',
                'label' => 'Fruit trees',
            ],
            [
                'list_name' => 'outputs',
                'name' => '4',
                'label' => 'Timber trees',
            ],
            [
                'list_name' => 'outputs',
                'name' => '5',
                'label' => 'Non-timber forest products',
            ],
            [
                'list_name' => 'outputs',
                'name' => '77',
                'label' => 'Other',
            ],
            [
                'list_name' => 'docs',
                'name' => '1',
                'label' => 'Title deed',
            ],
            [
                'list_name' => 'docs',
                'name' => '2',
                'label' => 'Certificate of customary tenure',
            ],
            [
                'list_name' => 'docs',
                'name' => '3',
                'label' => 'Certificate of occupancy',
            ],
            [
                'list_name' => 'docs',
                'name' => '4',
                'label' => 'Registered will or registered certificate of hereditary acquisition',
            ],
            [
                'list_name' => 'docs',
                'name' => '5',
                'label' => 'Registered certificate of perpetual / long term lease',
            ],
            [
                'list_name' => 'docs',
                'name' => '6',
                'label' => 'Registered rental contract',
            ],
            [
                'list_name' => 'docs',
                'name' => '7',
                'label' => 'Secure mobility corridor',
            ],
            [
                'list_name' => 'docs',
                'name' => '77',
                'label' => 'Other',
            ],
            [
                'list_name' => 'product_units',
                'name' => 'kg',
                'label' => 'Kg',
            ],
            [
                'list_name' => 'product_units',
                'name' => 'l',
                'label' => 'L',
            ],
            [
                'list_name' => 'product_units',
                'name' => 'num',
                'label' => 'Number of',
            ],
            [
                'list_name' => 'product_units',
                'name' => 'oth',
                'label' => 'Other',
            ],
            [
                'list_name' => 'natural_vegitation',
                'name' => '1',
                'label' => 'Absent: area covered with natural or diverse vegetation is negligible.',
            ],
            [
                'list_name' => 'natural_vegitation',
                'name' => '2',
                'label' => 'Small: less than 10% of the system is covered with natural or diverse vegetation.',
            ],
            [
                'list_name' => 'natural_vegitation',
                'name' => '3',
                'label' => 'Significant: at least 20% of the system is covered with natural or diverse vegetation.',
            ],
            [
                'list_name' => 'natural_vegitation',
                'name' => '4',
                'label' => 'Abundant: more than 25% of the system is covered with natural or diverse vegetation.',
            ],
            [
                'list_name' => 'beekeeping',
                'name' => '1',
                'label' => 'Yes, bees are raised and are very abudant within the agroecosystem.',
            ],
            [
                'list_name' => 'beekeeping',
                'name' => '2',
                'label' => 'Yes, bees are raised within the agroecosystem.',
            ],
            [
                'list_name' => 'beekeeping',
                'name' => '3',
                'label' => 'No, bees are not raised, but bees and pollinators are widespread within the agroecosystem.',
            ],
            [
                'list_name' => 'beekeeping',
                'name' => '4',
                'label' => 'No, bees are not raised and are rare within the agroecosystem.',
            ],
            [
                'list_name' => 'pollinators',
                'name' => '1',
                'label' => 'Abundant',
            ],
            [
                'list_name' => 'pollinators',
                'name' => '2',
                'label' => 'Significant',
            ],
            [
                'list_name' => 'pollinators',
                'name' => '3',
                'label' => 'Little',
            ],
            [
                'list_name' => 'pollinators',
                'name' => '4',
                'label' => 'Absent',
            ],
            [
                'list_name' => 'pasture',
                'name' => '1',
                'label' => 'Mostly with purchased feed',
            ],
            [
                'list_name' => 'pasture',
                'name' => '2',
                'label' => 'Both with purchased feed and on pasture',
            ],
            [
                'list_name' => 'pasture',
                'name' => '3',
                'label' => 'Only on pasture',
            ],
            [
                'list_name' => 'activities',
                'name' => '1',
                'label' => 'Agrotourism / ecotourism',
            ],
            [
                'list_name' => 'activities',
                'name' => '2',
                'label' => 'Transformation of products on farm',
            ],
            [
                'list_name' => 'activities',
                'name' => '3',
            'label' => 'Livestock services (rent, breeing services, others)',
            ],
            [
                'list_name' => 'activities',
                'name' => '4',
                'label' => 'Seed production',
            ],
            [
                'list_name' => 'activities',
                'name' => '5',
                'label' => 'Greenhouse or nursery sale',
            ],
            [
                'list_name' => 'activities',
                'name' => '6',
                'label' => 'Compost and organic fertilizers sale',
            ],
            [
                'list_name' => 'activities',
                'name' => '7',
            'label' => 'Rental of farm equipment (machineries, or similar)',
            ],
            [
                'list_name' => 'activities',
                'name' => '8',
                'label' => 'Rental of land',
            ],
            [
                'list_name' => 'activities',
                'name' => '9',
                'label' => 'Workshop or training',
            ],
            [
                'list_name' => 'activities',
                'name' => '10',
                'label' => 'Renawble energy sale',
            ],
            [
                'list_name' => 'activities',
                'name' => '11',
                'label' => 'Farm based events',
            ],
            [
                'list_name' => 'activities',
                'name' => '12',
                'label' => 'Carbon credits',
            ],
            [
                'list_name' => 'activities',
                'name' => '77',
            'label' => 'Other (please specify)',
            ],
            [
                'list_name' => 'sources',
                'name' => '1',
                'label' => 'crop production',
            ],
            [
                'list_name' => 'sources',
                'name' => '2',
                'label' => 'animal production',
            ],
            [
                'list_name' => 'sources',
                'name' => '3',
                'label' => 'other income-generating activities on farm',
            ],
            [
                'list_name' => 'sources',
                'name' => '4',
                'label' => 'salary earned off farm',
            ],
            [
                'list_name' => 'sources',
                'name' => '5',
                'label' => 'remittances from a family member emigrated',
            ],
            [
                'list_name' => 'sources',
                'name' => '77',
            'label' => 'other (please specify)',
            ],
            [
                'list_name' => 'product_destinations',
                'name' => '1',
                'label' => 'Sale',
            ],
            [
                'list_name' => 'product_destinations',
                'name' => '2',
                'label' => 'Mostly sale and a small part of self-consumption',
            ],
            [
                'list_name' => 'product_destinations',
                'name' => '3',
                'label' => 'Equally sale and self-consumption',
            ],
            [
                'list_name' => 'product_destinations',
                'name' => '4',
                'label' => 'Mostly self-consumption and a small part of sale',
            ],
            [
                'list_name' => 'product_destinations',
                'name' => '5',
                'label' => 'Self-consumption',
            ],
            [
                'list_name' => 'income_compare',
                'name' => '1',
                'label' => 'Much more income',
            ],
            [
                'list_name' => 'income_compare',
                'name' => '2',
                'label' => 'More income',
            ],
            [
                'list_name' => 'income_compare',
                'name' => '3',
                'label' => 'Same income',
            ],
            [
                'list_name' => 'income_compare',
                'name' => '4',
                'label' => 'Less income',
            ],
            [
                'list_name' => 'income_compare',
                'name' => '5',
                'label' => 'Much less income',
            ],
            [
                'list_name' => 'stable_income',
                'name' => '0',
                'label' => 'Very unstable and decreasing trend.',
            ],
            [
                'list_name' => 'stable_income',
                'name' => '1',
                'label' => 'Unstable with notable fluctuations.',
            ],
            [
                'list_name' => 'stable_income',
                'name' => '2',
                'label' => 'Neutral, sometimes up, sometimes down.',
            ],
            [
                'list_name' => 'stable_income',
                'name' => '3',
                'label' => 'Stable with minor fluctuations.',
            ],
            [
                'list_name' => 'stable_income',
                'name' => '4',
                'label' => 'Very stable and growing trend.',
            ],
            [
                'list_name' => 'comparison',
                'name' => '0',
                'label' => 'much worse',
            ],
            [
                'list_name' => 'comparison',
                'name' => '1',
                'label' => 'worse',
            ],
            [
                'list_name' => 'comparison',
                'name' => '2',
                'label' => 'same',
            ],
            [
                'list_name' => 'comparison',
                'name' => '3',
                'label' => 'better',
            ],
            [
                'list_name' => 'comparison',
                'name' => '4',
                'label' => 'much better',
            ],
            [
                'list_name' => 'envision_future',
                'name' => '0',
                'label' => 'I am very concerned that the agricultural production on my farm will decline, jeopardizing my household\'s livelihood.',
            ],
            [
                'list_name' => 'envision_future',
                'name' => '1',
                'label' => 'I have doubts about the future of my agricultural production, and I\'m uncertain if it will be able to fully sustain my household\'s livelihood.',
            ],
            [
                'list_name' => 'envision_future',
                'name' => '2',
                'label' => 'My agricultural production will probably remain at the same level without significant changes.',
            ],
            [
                'list_name' => 'envision_future',
                'name' => '3',
                'label' => 'I am hopeful about the future of my agricultural production, and I believe it will bring some improvements to my household\'s livelihood.',
            ],
            [
                'list_name' => 'envision_future',
                'name' => '4',
                'label' => 'I am very confident that the agricultural production on my farm will thrive and continue to sustain my household\'s livelihood for many years to come.',
            ],
            [
                'list_name' => 'pesticide_units',
                'name' => 'l',
                'label' => 'Liters',
            ],
            [
                'list_name' => 'pesticide_units',
                'name' => 'g',
                'label' => 'Grams',
            ],
            [
                'list_name' => 'toxicity',
                'name' => '1',
                'label' => 'Extremely/highly toxic',
            ],
            [
                'list_name' => 'toxicity',
                'name' => '2',
                'label' => 'Moderately toxic',
            ],
            [
                'list_name' => 'toxicity',
                'name' => '3',
                'label' => 'Slightly toxic or relatively non-toxic',
            ],
            [
                'list_name' => 'self_or_purchased',
                'name' => 'sp',
                'label' => 'Self-produced',
            ],
            [
                'list_name' => 'self_or_purchased',
                'name' => 'p',
                'label' => 'Purchased',
            ],
            [
                'list_name' => 'mitigation_strategies',
                'name' => '1',
                'label' => 'Mask',
            ],
            [
                'list_name' => 'mitigation_strategies',
                'name' => '2',
            'label' => 'Body protection (glasses, gloves, etc.)',
            ],
            [
                'list_name' => 'mitigation_strategies',
                'name' => '3',
                'label' => 'Special protection for women and children',
            ],
            [
                'list_name' => 'mitigation_strategies',
                'name' => '4',
                'label' => 'Visible signs of danger after spraying',
            ],
            [
                'list_name' => 'mitigation_strategies',
                'name' => '5',
                'label' => 'Community is informed of the danger',
            ],
            [
                'list_name' => 'mitigation_strategies',
                'name' => '6',
                'label' => 'Secure disposal of the empty containers after use',
            ],
            [
                'list_name' => 'mitigation_strategies',
                'name' => '77',
                'label' => 'Other',
            ],
            [
                'list_name' => 'mitigation_strategies',
                'name' => '8',
                'label' => 'None of these',
            ],
            [
                'list_name' => 'eco_management_methods',
                'name' => '1',
            'label' => 'Cultural control (more resistant varieties are chosen for production; plants and fruits presenting signs of disease are removed manually; crops are grown in crop rotation and intercropping schemes, etc.)',
            ],
            [
                'list_name' => 'eco_management_methods',
                'name' => '2',
                'label' => 'Plantation of natural repelling plants',
            ],
            [
                'list_name' => 'eco_management_methods',
                'name' => '3',
                'label' => 'Use of cover crops to increase biological interactions',
            ],
            [
                'list_name' => 'eco_management_methods',
                'name' => '4',
                'label' => 'Favor the reproduction of beneficial organisms for biological-control',
            ],
            [
                'list_name' => 'eco_management_methods',
                'name' => '5',
                'label' => 'Favor biodiversity and spatial diversity within the agroecosystem',
            ],
            [
                'list_name' => 'eco_management_methods',
                'name' => '77',
                'label' => 'Other',
            ],
            [
                'list_name' => 'eco_management_methods',
                'name' => '7',
                'label' => 'None of these',
            ],
            [
                'list_name' => 'cpesticides_future',
                'name' => '1',
                'label' => 'I would like to use more chemical pesiticides',
            ],
            [
                'list_name' => 'cpesticides_future',
                'name' => '2',
                'label' => 'I would like to use some chemical pesticides',
            ],
            [
                'list_name' => 'cpesticides_future',
                'name' => '3',
                'label' => 'I would like to use just enough quantity',
            ],
            [
                'list_name' => 'cpesticides_future',
                'name' => '4',
                'label' => 'I would like to stop using chemical pesticides totally',
            ],
            [
                'list_name' => 'cpesticides_future',
                'name' => '-99',
            'label' => 'NA (e.g. the farmer does not use chemical pesticides)',
            ],
            [
                'list_name' => 'occupations',
                'name' => '1',
                'label' => 'Working in the agricultural production within the system assessed',
            ],
            [
                'list_name' => 'occupations',
                'name' => '2',
                'label' => 'Both working in the agricultural production within the system and also employed outside the system',
            ],
            [
                'list_name' => 'occupations',
                'name' => '3',
                'label' => 'Employed outside the system assessed',
            ],
            [
                'list_name' => 'occupations',
                'name' => '4',
                'label' => 'Both working in the agricultural production within the system and also enrolled in formal education',
            ],
            [
                'list_name' => 'occupations',
                'name' => '5',
                'label' => 'Enrolled in formal education',
            ],
            [
                'list_name' => 'occupations',
                'name' => '0',
                'label' => 'Not working nor studying',
            ],
            [
                'list_name' => 'occupations',
                'name' => '6',
                'label' => 'Works in his/her own farm',
            ],
            [
                'list_name' => 'y_emig_where',
                'name' => '1',
                'label' => 'to another farm in the area',
            ],
            [
                'list_name' => 'y_emig_where',
                'name' => '2',
                'label' => 'to the nearest city',
            ],
            [
                'list_name' => 'y_emig_where',
                'name' => '3',
                'label' => 'within the country',
            ],
            [
                'list_name' => 'y_emig_where',
                'name' => '4',
                'label' => 'in a neighbouring country',
            ],
            [
                'list_name' => 'y_emig_where',
                'name' => '5',
                'label' => 'abroad in a far away country',
            ],
            [
                'list_name' => 'y_emig_why',
                'name' => '1',
                'label' => 'study',
            ],
            [
                'list_name' => 'y_emig_why',
                'name' => '2',
                'label' => 'looking for a job in agriculture',
            ],
            [
                'list_name' => 'y_emig_why',
                'name' => '3',
                'label' => 'looking for a job outside agriculture',
            ],
            [
                'list_name' => 'y_emig_why',
                'name' => '4',
                'label' => 'lack of good living conditions in the farm',
            ],
            [
                'list_name' => 'y_emig_why',
                'name' => '77',
                'label' => 'other',
            ],
            [
                'list_name' => 'y_emig_return',
                'name' => '4',
                'label' => 'Yes, for sure',
            ],
            [
                'list_name' => 'y_emig_return',
                'name' => '3',
                'label' => 'Yes, likely',
            ],
            [
                'list_name' => 'y_emig_return',
                'name' => '2',
                'label' => 'Maybe',
            ],
            [
                'list_name' => 'y_emig_return',
                'name' => '1',
                'label' => 'Probably not',
            ],
            [
                'list_name' => 'y_emig_return',
                'name' => '0',
                'label' => 'For sure not',
            ],
            [
                'list_name' => 'education_levels',
                'name' => '1',
                'label' => 'Cannot read nor write',
            ],
            [
                'list_name' => 'education_levels',
                'name' => '2',
                'label' => 'Able to read and write',
            ],
            [
                'list_name' => 'education_levels',
                'name' => '3',
                'label' => 'Elementary',
            ],
            [
                'list_name' => 'education_levels',
                'name' => '4',
                'label' => 'High school',
            ],
            [
                'list_name' => 'education_levels',
                'name' => '5',
                'label' => 'University or higher',
            ],
            [
                'list_name' => 'gender_decision_making',
                'name' => '1',
                'label' => 'Completely the man',
            ],
            [
                'list_name' => 'gender_decision_making',
                'name' => '2',
                'label' => 'Mostly the man',
            ],
            [
                'list_name' => 'gender_decision_making',
                'name' => '3',
                'label' => 'Both man and woman',
            ],
            [
                'list_name' => 'gender_decision_making',
                'name' => '4',
                'label' => 'Mostly the woman',
            ],
            [
                'list_name' => 'gender_decision_making',
                'name' => '5',
                'label' => 'Completely the woman',
            ],
            [
                'list_name' => 'gender_decision_making',
                'name' => '6',
                'label' => 'Someone else outside the family',
            ],
            [
                'list_name' => 'gender_decision_making',
                'name' => '88',
                'label' => 'Not applicable',
            ],
            [
                'list_name' => 'credit',
                'name' => '1',
            'label' => 'Possible in official and secure channels (bank or similar)',
            ],
            [
                'list_name' => 'credit',
                'name' => '2',
                'label' => 'Possible in non-official channels',
            ],
            [
                'list_name' => 'credit',
                'name' => '3',
                'label' => 'Not possible. Access to credit is too hard or too risky',
            ],
            [
                'list_name' => 'involvement_in_orgs',
                'name' => '1',
                'label' => 'I do not participate in such organizations',
            ],
            [
                'list_name' => 'involvement_in_orgs',
                'name' => '2',
                'label' => 'I rarely participate in such meetings / organizations',
            ],
            [
                'list_name' => 'involvement_in_orgs',
                'name' => '3',
                'label' => 'I participate often but I rarely speak in the meetings',
            ],
            [
                'list_name' => 'involvement_in_orgs',
                'name' => '4',
                'label' => 'I am an active member of such organization sometimes I speak in the meetings',
            ],
            [
                'list_name' => 'involvement_in_orgs',
                'name' => '5',
                'label' => 'I often speak in the meetings and participate in the decisions making processes',
            ],
            [
                'list_name' => 'level_fies',
                'name' => '0',
                'label' => 'Never',
            ],
            [
                'list_name' => 'level_fies',
                'name' => '1',
                'label' => 'Rarely',
            ],
            [
                'list_name' => 'level_fies',
                'name' => '2',
                'label' => 'Sometimes',
            ],
            [
                'list_name' => 'level_fies',
                'name' => '3',
                'label' => 'Often',
            ],
            [
                'list_name' => 'level_fies',
                'name' => '-99',
                'label' => 'Don\'t know / Refused to answer',
            ],
            [
                'list_name' => 'dietyn',
                'name' => '1',
                'label' => 'Yes, I ate it in the last 24 hours',
            ],
            [
                'list_name' => 'dietyn',
                'name' => '0',
                'label' => 'No, I did not eat it in the last 24 hours',
            ],
            [
                'list_name' => 'dietyn',
                'name' => '-99',
                'label' => 'M',
            ],
            [
                'list_name' => 'soil_structure',
                'name' => '1',
                'label' => '1 Loose, powdery soil without visible aggregates',
            ],
            [
                'list_name' => 'soil_structure',
                'name' => '2',
                'label' => '2',
            ],
            [
                'list_name' => 'soil_structure',
                'name' => '3',
                'label' => '3 Few aggregates that break with little pressure',
            ],
            [
                'list_name' => 'soil_structure',
                'name' => '4',
                'label' => '4',
            ],
            [
                'list_name' => 'soil_structure',
                'name' => '5',
                'label' => '5 Well-formed aggregates – difficult to break',
            ],
            [
                'list_name' => 'soil_compaction',
                'name' => '1',
                'label' => '1 Compacted soil, flag bends readily',
            ],
            [
                'list_name' => 'soil_compaction',
                'name' => '2',
                'label' => '2',
            ],
            [
                'list_name' => 'soil_compaction',
                'name' => '3',
                'label' => '3 Thin compacted layer, some restrictions to a penetrating wire',
            ],
            [
                'list_name' => 'soil_compaction',
                'name' => '4',
                'label' => '4',
            ],
            [
                'list_name' => 'soil_compaction',
                'name' => '5',
                'label' => '5 No compaction, flag can penetrate all the way into the soil',
            ],
            [
                'list_name' => 'soil_depth',
                'name' => '1',
                'label' => '1 Thin soil > 1 foot until you hit rock or there is exposed rock on the soil surface',
            ],
            [
                'list_name' => 'soil_depth',
                'name' => '2',
                'label' => '2',
            ],
            [
                'list_name' => 'soil_depth',
                'name' => '3',
            'label' => '3 Shallow to moderate soil – less than 3 feet (1 meter) until you reach bedrock',
            ],
            [
                'list_name' => 'soil_depth',
                'name' => '4',
                'label' => '4',
            ],
            [
                'list_name' => 'soil_depth',
                'name' => '5',
                'label' => '5 Deep soil, more than three feet deepSuperficial soil',
            ],
            [
                'list_name' => 'soil_residues',
                'name' => '1',
                'label' => '1 Organic residues are applied but decomposition is very slow, more than 1 year',
            ],
            [
                'list_name' => 'soil_residues',
                'name' => '2',
                'label' => '2',
            ],
            [
                'list_name' => 'soil_residues',
                'name' => '3',
                'label' => '3 Residues are visible they are slowly decomposing during the season',
            ],
            [
                'list_name' => 'soil_residues',
                'name' => '4',
                'label' => '4',
            ],
            [
                'list_name' => 'soil_residues',
                'name' => '5',
                'label' => '5 Residues are quickly decomposed and we can see various stages of decomposition',
            ],
            [
                'list_name' => 'soil_color',
                'name' => '1',
                'label' => '1 Pale and no presence of humus',
            ],
            [
                'list_name' => 'soil_color',
                'name' => '2',
                'label' => '2',
            ],
            [
                'list_name' => 'soil_color',
                'name' => '3',
                'label' => '3 Light brown, odorless, and some presence of humus',
            ],
            [
                'list_name' => 'soil_color',
                'name' => '4',
                'label' => '4',
            ],
            [
                'list_name' => 'soil_color',
                'name' => '5',
                'label' => '5 Dark brown, fresh odor, and abundant humus',
            ],
            [
                'list_name' => 'soil_water_ret',
                'name' => '1',
                'label' => '1 Dry soil, does not hold water',
            ],
            [
                'list_name' => 'soil_water_ret',
                'name' => '2',
                'label' => '2',
            ],
            [
                'list_name' => 'soil_water_ret',
                'name' => '3',
                'label' => '3 Limited moisture level available for short time',
            ],
            [
                'list_name' => 'soil_water_ret',
                'name' => '4',
                'label' => '4',
            ],
            [
                'list_name' => 'soil_water_ret',
                'name' => '5',
                'label' => '5 Reasonable moisture level for a reasonable period of time',
            ],
            [
                'list_name' => 'soil_cover',
                'name' => '1',
                'label' => '1 Bare soil',
            ],
            [
                'list_name' => 'soil_cover',
                'name' => '2',
                'label' => '2',
            ],
            [
                'list_name' => 'soil_cover',
                'name' => '3',
                'label' => '3 Less than 50% soil covered by residues or live cover',
            ],
            [
                'list_name' => 'soil_cover',
                'name' => '4',
                'label' => '4',
            ],
            [
                'list_name' => 'soil_cover',
                'name' => '5',
                'label' => '5 More than 50% soil covered by residues or live cover',
            ],
            [
                'list_name' => 'soil_erosion',
                'name' => '1',
                'label' => '1 Severe erosion, presence of gullies',
            ],
            [
                'list_name' => 'soil_erosion',
                'name' => '2',
                'label' => '2',
            ],
            [
                'list_name' => 'soil_erosion',
                'name' => '3',
            'label' => '3 Evident, but low erosion signs (e.g. rill/sheet erosion)',
            ],
            [
                'list_name' => 'soil_erosion',
                'name' => '4',
                'label' => '4',
            ],
            [
                'list_name' => 'soil_erosion',
                'name' => '5',
                'label' => '5 No visible signs of erosion',
            ],
            [
                'list_name' => 'soil_invertebrates',
                'name' => '1',
                'label' => '1 No signs of invertebrate presence or activity',
            ],
            [
                'list_name' => 'soil_invertebrates',
                'name' => '2',
                'label' => '2',
            ],
            [
                'list_name' => 'soil_invertebrates',
                'name' => '3',
                'label' => '3 A few earthworms and arthropods present',
            ],
            [
                'list_name' => 'soil_invertebrates',
                'name' => '4',
                'label' => '4',
            ],
            [
                'list_name' => 'soil_invertebrates',
                'name' => '5',
                'label' => '5 Abundant presence of invertebrate organisms',
            ],
            [
                'list_name' => 'soil_microbio',
                'name' => '1',
                'label' => '1 Very little effervescence after application of water peroxide to the topsoil',
            ],
            [
                'list_name' => 'soil_microbio',
                'name' => '2',
                'label' => '2',
            ],
            [
                'list_name' => 'soil_microbio',
                'name' => '3',
                'label' => '3 Light to medium effervescence',
            ],
            [
                'list_name' => 'soil_microbio',
                'name' => '4',
                'label' => '4',
            ],
            [
                'list_name' => 'soil_microbio',
                'name' => '5',
                'label' => '5 Abundant - longer effervescences period',
            ],
        ]);


    }
}
