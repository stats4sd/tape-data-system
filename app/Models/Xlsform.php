<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Stats4sd\FilamentOdkLink\Models\OdkLink\XlsformVersion;

class Xlsform extends \Stats4sd\FilamentOdkLink\Models\OdkLink\Xlsform
{
    public function submissions(): HasManyThrough
    {
        return $this->hasManyThrough(Submission::class, XlsformVersion::class);
    }
}
