<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface SchemaAggregateFactory
{
    public function createSchemaAggregate(): SchemaAggregate;
}
