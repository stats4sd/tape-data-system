<x-filament-widgets::widget>
    @if(!$this->hasLocations())
        <x-filament::section title="Locations" icon="heroicon-o-exclamation-circle" icon-color="danger" heading="No Viable Locations Found">
            <p>
                There are no locations that can have farms assigned. Please check the <a class="underline text-blue-600" href="{{\App\Filament\App\Resources\LocationLevelResource::getUrl('index')}}">sample frame page</a> to add administrative levels and locations before you import your list of farms.

            </p>
        </x-filament::section>
    @endif
</x-filament-widgets::widget>
