@php

    $locations = \App\Models\SampleFrame\Location::where('owner_id', \App\Services\HelperService::getSelectedTeam()->id)->get();

    $submissions = $getRecord()->submissions;

    $submissionsByLocations = $submissions->map(function(\Stats4sd\FilamentOdkLink\Models\OdkLink\Submission $submission) {

        $submission->location_id = $submission->content['reg']['final_location_id'];

        return $submission;
    })
    ->groupBy('location_id');

    $submissionsByEnumerators = $submissions->map(function(\Stats4sd\FilamentOdkLink\Models\OdkLink\Submission $submission) {

        $submission->enumerator_id = $submission->content['survey_start']['inquirer'];

        return $submission;
    })->groupBy('enumerator_id');

@endphp

<div class="grid grid-cols-2 gap-8">

    <x-filament::section>
        <x-slot name="heading">
            <b>Submissions By Location</b>
        </x-slot>

        <div class="grid grid-cols-3 gap-3">
            @foreach($submissionsByLocations as $key => $locationFromSubmission)
                <b class="text-right">{{ $locations->firstWhere('id', $key)?->name ?? $key }}</b>
                <span class="col-span-2"">{{ $locationFromSubmission->count() }}</span>
            @endforeach
        </div>

    </x-filament::section>

    <x-filament::section>
        <x-slot name="heading">
            <b>Submissions By Enumerator</b>
        </x-slot>

        <div class="grid grid-cols-3 gap-3">
            @foreach($submissionsByEnumerators as $key => $enumeratorSubmissions)
                <b class="text-right col-span-2">{{ \Illuminate\Support\Str::replace("_", " ", $key) }}</b>
                <span>{{ $enumeratorSubmissions->count() }}</span>

            @endforeach
        </div>

    </x-filament::section>
</div>
