<?php

namespace App\Models\Traits;


/**
 * For models that have a json 'properties' field for storing additional data.
 */
trait HasProperties
{

    public function updateProps(array $updates): self
    {
        $props = $this->properties ?? collect([]);

        foreach ($updates as $propName => $propValue) {
            $props[$propName] = $propValue;
        }

        $this->update(['properties' => $props]);

        return $this;
    }
}
