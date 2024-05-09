<x-filament-panels::page>

    {{ $this->record->title }}: Survey Monitoring

    <!-- TODO: refine page layout -->

    <p>
        Number of Live Submissions: {{ $this->getSummary()['count'] }}
    </p>

    <p>
        Latest Submission: {{ $this->getSummary()['latestSubmissionDate'] }}
    </p>

    <p>
        Submissions In Local Database: {{ count($this->record->submissions) }}
    </p>


    <a href="TODO">DOWNLOAD RAW SURVEY DATA</a>


</x-filament-panels::page>