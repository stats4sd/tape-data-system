<x-filament-breezy::grid-section md=2
                                 title="User Role and Team"
                                 description="Review your site-wide user role and team memberships">
    <x-filament::card>
        <form wire:submit.prevent="submit" class="space-y-6">

            {{ $this->infolist }}

        </form>
    </x-filament::card>
</x-filament-breezy::grid-section>
