<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface ReferenceFactory extends
    SchemaAggregateFactory,
    ExampleAggregateFactory,
    HeaderAggregateFactory,
    ResponseAggregateFactory
{
    public function createReference(): Reference;
}
