<?php

namespace App\Models\Traits;

/**
 * For models that have a json 'properties' field for storing additional data.
 */
trait HasProperties
{
    public function updateProperties(array $updates): self
    {
        $props = $this->properties ?? collect([]);

        foreach ($updates as $propName => $propValue) {
            $props[$propName] = $propValue;
        }

        $this->update(['properties' => $props]);

        return $this;
    }

    public function propertyIsCompleted(string $key): bool
    {

        // if the model has a separate 'properties_complete' field for manually stating the completion status, use that
        if ($this->propertiesAreCompletable) {
            return $this->properties_complete?->get($key, false) ?? false;
        }

        return $this->propertyHasValue($key);
    }

    public function propertyHasValue(string $key): bool
    {
        return $this->properties?->has($key) ?? false;
    }
}
