<x-filament-panels::page>

    <x-filament::section>
        <x-slot name="heading">
            <b>Live Submissions</b>
        </x-slot>
        <p>
            <b>Number of Live Submissions:</b> {{ $this->getSummary()['count'] }}
        </p>
        <br />
        <p>
            <b>Latest Submission:</b> {{ $this->getSummary()['latestSubmissionDate'] }}
        </p>
        <br />
        <p>
            <b>Submissions In Local Database:</b> {{ count($this->record->submissions) }}
            <br />
            <small>The Live Submissions count above is updated in real time. The number of submissions in the local database may not be fully up to date due to the time it takes to sync with the ODK System.</small>
        </p>
    </x-filament::section>

</x-filament-panels::page>