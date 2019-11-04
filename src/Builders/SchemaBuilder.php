<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class SchemaBuilder implements Objects\SchemaFactory
{
    use Properties\OptionalExtensions;

    private $attributes = [];

    public function createSchema(): Objects\Schema
    {
        return new Objects\Schema(
            $this->getAttributes(),
            $this->getExtensions()
        );
    }

    public function createSchemaAggregate(): Objects\SchemaAggregate
    {
        return $this->createSchema();
    }

    public function setAttributes(array $attributes): self
    {
        $this->attributes = $attributes;

        return $this;
    }

    private function getAttributes(): array
    {
        return $this->attributes;
    }
}
