<?php

namespace App\Models;

use App\Models\LookupTables\Unit;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UnitType extends Model
{
    public function units(): HasMany
    {
        return $this->hasMany(Unit::class);
    }

    public function label(): Attribute
    {
        return new Attribute(
            get: fn (): string => $this->name . ' (Standard unit: ' . $this->si_unit . ')'
        );
    }

}
