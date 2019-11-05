<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface SchemaFactory extends SchemaAggregateFactory
{
    public function createSchema(): Schema;
}
