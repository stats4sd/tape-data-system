<?php

namespace App\Models\Interfaces;

// The required methods for a model to be used as a source for a csv file that will be published to ODK as a media attachment.
use Stats4sd\FilamentOdkLink\Models\OdkLink\Interfaces\WithXlsforms;

interface LookupListEntry
{
    public static function getLinkedDataset(): ?\App\Models\Dataset;

    public function isGlobalEntry(): \Illuminate\Database\Eloquent\Casts\Attribute;

    public function isGlobal(): bool;

    public function isCustomisedEntry(): \Illuminate\Database\Eloquent\Casts\Attribute;

    public function isCustomised(): bool;

    public function owner(): \Illuminate\Database\Eloquent\Relations\MorphTo;

    /**
     * Function to generate any extra rows that are always required for the csv lookup file (e.g. "other", "none", etc)
     * When using search(), these rows are usually specified in the XLSform itself, but when using select_*_from_file all the entries must be in the file)
     */
    public function getExtraCsvRows(): ?array;

    // Defines what goes into the csv file that will be published to ODK
    public function getCsvContentsForOdk(?WithXlsforms $team = null): array;

}
