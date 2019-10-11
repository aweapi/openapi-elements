<?php

declare(strict_types=1);

namespace Waspes\Objects;

use Countable;

final class ExtensionMap implements Definition, Countable
{
    private $values = [];

    public function __construct(iterable $values = [])
    {
        foreach ($values as $key => $value) {
            // The value can be null, a primitive, an array or an object.
            // Can have any valid JSON format value. So must not be filtered.
            $this->values[$key] = $value;
        }
    }

    public function count(): int
    {
        return count($this->values);
    }

    public function extendValues(?array $properties): ?array
    {
        if ($this->count() === 0) {
            return $properties;
        }

        if (empty($properties)) {
            return $this->jsonSerialize();
        }

        return $properties + $this->jsonSerialize();
    }

    /**
     * @return mixed
     */
    public function getExtension(string $key)
    {
        return $this->values[$key];
    }

    public function hasExtension(string $key): bool
    {
        return array_key_exists($key, $this->values);
    }

    public function jsonSerialize(): array
    {
        return $this->values;
    }
}
