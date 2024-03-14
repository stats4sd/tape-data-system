<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dataset extends \Stats4sd\FilamentOdkLink\Models\OdkLink\Dataset
{
    public function databaseTable(): Attribute
    {
        return new Attribute(
            get: fn (): string => $this->entity_model ? $this->entity_model::getTable() : '',
        );
    }
}
