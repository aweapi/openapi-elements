<?php

declare(strict_types=1);

namespace Waspes\Objects;

final class Discriminator extends ValueObject
{
    private $mapping = [];

    private $propertyName;

    public function __construct(
        string $propertyName,
        iterable $mapping = []
    ) {
        $this->propertyName = $propertyName;

        foreach ($mapping as $name => $reference) {
            $this->mapping[$name] = $reference;
        }
    }

    public function getMapping(): array
    {
        return $this->mapping;
    }

    public function getPropertyName(): string
    {
        return $this->propertyName;
    }

    protected function normalizeOptionalProperties(): array
    {
        return [
            'mapping' => $this->getMapping(),
        ];
    }

    protected function normalizeRequiredProperties(): array
    {
        return [
            'propertyName' => $this->getPropertyName(),
        ];
    }
}
