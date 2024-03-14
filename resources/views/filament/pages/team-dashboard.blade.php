@php

$widgetData = $this->getWidgetData();
$record = $this->getRecord();

@endphp

<x-filament-panels::page>

    <div class="flex mx-10 gap-x-10">

        <x-progress-header-entry :percent="$record->step0_percent" :step-name="'Step 0'" :status="'In Progress'"/>
        <x-progress-header-entry :percent="100" :step-name="'Prep'" :status="'Complete'"/>
        <x-progress-header-entry :percent="100" :step-name="'Step 1'" :status="'Complete'"/>
        <x-progress-header-entry :percent="100" :step-name="'Step 2'" :status="'Complete'"/>
        <x-progress-header-entry :percent="50" :step-name="'Step 3'" :status="'In Progress'"/>

    </div>

    @if ($headerWidgets = $this->getSummaryWidgets())
        <x-filament-widgets::widgets
            :columns="$this->getHeaderWidgetsColumns()"
            :data="$widgetData"
            :widgets="$headerWidgets"
            class="fi-page-header-widgets"
        />
    @endif

    <h2 class="mt-10 text-2xl font-semibold text-gray-800 dark:text-white">Actions</h2>


    <div class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4">
    @foreach($this->getTeamActions() as $action)
        <x-action-card :title="$action['title']" :description="$action['description']" :link="$action['url']" :button-text="$action['button_text']"/>

    @endforeach
    </div>

</x-filament-panels::page>
