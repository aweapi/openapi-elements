<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface ReferenceFactory extends SchemaAggregateFactory, ExampleAggregateFactory
{
    public function createReference(): Reference;
}
