<?php

namespace App\Models\SurveyData;

use Illuminate\Database\Eloquent\Model;

class SimpleFormMain extends Model
{
    protected $table = 'simple_form_main';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
}
