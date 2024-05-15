<?php

namespace App\Models\Testing;

use Illuminate\Database\Eloquent\Model;

/*
 * FOR TESTING ONLY
 */
class DrinksFormDrinkRepeat extends Model
{
    // Specify database table name explicitly
    protected $table = 'drinks_form_drink_repeat';

    /**
     * The attributes that aren't mass assignable.
     *
     * P.S. These attributes should not be imported from ODK submission,
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
}
