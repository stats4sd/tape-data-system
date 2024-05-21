<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Brick\Math\BigInteger;
use Illuminate\Support\Arr;
use App\Services\HelperService;
use App\Http\Controllers\Controller;
use Stats4sd\FilamentOdkLink\Models\OdkLink\Submission;

class SubmissionForeignKeyController extends Controller
{
    const OTHERS = -99;

    // This function will be called when there is foreign key record need to be created when pulling new submissions from ODK central
    public static function process($entry, $owner, $foreignKeyColumnName, $foreignKeyColumnValue, $foreignKeyTableName): int
    {
        // application specific business logic goes here
        // logger('SubmissionForeignKeyController.process()...');

        // check whether it is required to create a new record in foreign key table
        if ($foreignKeyColumnValue != self::OTHERS) {
            return -1;
        }

        // check whether there is a corresponding model by table name
        $model = HelperService::getModelByTablename($foreignKeyTableName);

        if ($model == null) {
            return -1;
        }

        $foreignKeyTableDataArray = self::prepareForeignKeyTableDataArray($entry, $foreignKeyColumnName);

        $newRecord = $model::create($foreignKeyTableDataArray);

        // add xlsform's owner as farm's owner
        $newRecord->owner()->associate($owner)->save();

        // set foreign key table new record id to foreign key column in this table
        return $newRecord->id;
    }


    // a function to prepare data array for creating a new record in foreign key table
    private static function prepareForeignKeyTableDataArray($entry, $foreignKeyName): array
    {
        $result = [];

        switch ($foreignKeyName) {
            case 'farm_id':
                // get required information from submission entry directly

                // Question: any idea to avoid adding extra double quote character in JSON content...?
                $respondentName = Arr::get($entry, 'root.farm_info.respondent_name');
                $identifiers = ['name' => $respondentName];
                $result['identifiers'] = $identifiers;
                // logger($result['identifiers']);

                $result['location_id'] = Arr::get($entry, 'root.reg.final_location_id');
                // logger($result['location_id']);

                $result['latitude'] = Arr::get($entry, 'root.farm_info.gps_loc.coordinates')[0];
                // logger($result['latitude']);

                $result['longitude'] = Arr::get($entry, 'root.farm_info.gps_loc.coordinates')[1];
                // logger($result['longitude']);

                $result['altitude'] = Arr::get($entry, 'root.farm_info.gps_loc.coordinates')[2];
                // logger($result['altitude']);

                // prefix C for comparison farm, append timestamp in millsecond, hopefully it would be good enough to avoid duplication
                $result['team_code'] = 'C' . Carbon::now()->getTimestampMs();
                // logger($result['team_code']);

                break;

            default:
        }

        return $result;
    }
}
