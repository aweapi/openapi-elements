<?php

declare(strict_types=1);

namespace Aweapi\Openapi;

use stdClass;

abstract class ValueObject implements Definition
{
    public function jsonSerialize(): ?array
    {
        $properties = $this->normalizeRequiredProperties();

        foreach ($this->normalizeOptionalProperties() as $name => $value) {
            if ($value !== null && $value !== []) {
                $properties[$name] = $value;
            }
        }

        return $properties ?: null;
    }

    /**
     * Use this instead of empty maps for required properties to force JSON-object.
     */
    protected static function emptyObject(): stdClass
    {
        return new stdClass();
    }

    protected function normalizeOptionalProperties(): array
    {
        return [];
    }

    protected function normalizeRequiredProperties(): array
    {
        return [];
    }
}
