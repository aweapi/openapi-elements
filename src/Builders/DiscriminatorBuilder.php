<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class DiscriminatorBuilder implements Objects\DiscriminatorFactory
{
    private $mapping = [];

    private $propertyName;

    public function createDiscriminator(): Objects\Discriminator
    {
        return new Objects\Discriminator(
            $this->getPropertyName(),
            $this->getMapping()
        );
    }

    public function setMapping(array $mapping): self
    {
        $this->mapping = $mapping;

        return $this;
    }

    public function setPropertyName(string $propertyName): self
    {
        $this->propertyName = $propertyName;

        return $this;
    }

    private function getMapping(): array
    {
        return $this->mapping;
    }

    private function getPropertyName(): string
    {
        return $this->propertyName;
    }
}
