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

    public function togglePropertyCompleted(string $name): bool
    {
        $propsComplete = $this->properties_complete ?? collect([]);

        // if the property hasn't been set before, set it to true (toggle)
        if($propsComplete->keys()->doesntContain($name)) {
            $propsComplete[$name] = true;
        } else {
            $propsComplete[$name] = !$propsComplete[$name];
        }


        $this->update(['properties_complete' => $propsComplete]);


        ray(!$this->properties_complete->get($name, false));
        ray($this->properties_complete->toArray());


        return $this->propertyIsCompleted($name);
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
