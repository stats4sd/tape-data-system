<?php

namespace App\Filament\Infolists\Components;

use Filament\Infolists\Components\RepeatableEntry;
use Illuminate\Database\Eloquent\Model;

class ListRepeatableEntry extends RepeatableEntry
{
    protected string $view = 'filament.infolists.components.repeatable-list-entry';

    public function getChildComponentContainers(bool $withHidden = false): array
    {
        if ((!$withHidden) && $this->isHidden()) {
            return [];
        }

        $containers = [];

        foreach ($this->getState() ?? [] as $itemKey => $itemData) {
            $container = $this
                ->getChildComponentContainer()
                ->getClone()
                ->statePath($itemKey)
                ->inlineLabel(false);

            if ($itemData instanceof Model) {
                $container->record($itemData);
            }

            $containers[$itemKey] = $container;
        }

        return $containers;
    }

    public function getChildComponentContainer($key = null): ComponentContainer
    {
        if (filled($key)) {
            return $this->getChildComponentContainers()[$key];
        }

        return ComponentContainer::make($this->getLivewire())
            ->parentComponent($this)
            ->components($this->getChildComponents());
    }

}
