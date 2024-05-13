<?php

namespace App\Models\SurveyData;

use Illuminate\Database\Eloquent\Model;

class DrinksFormMain extends Model
{
    // Specify database table name explicitly
    protected $table = 'drinks_form_main';

    /**
     * The attributes that aren't mass assignable.
     *
     * P.S. These attributes should not be imported from ODK submission,
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
}
