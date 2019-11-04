<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface ReferenceFactory extends SchemaAggregateFactory, ExampleAggregateFactory, HeaderAggregateFactory
{
    public function createReference(): Reference;
}
