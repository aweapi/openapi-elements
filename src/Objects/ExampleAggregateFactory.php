<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface ExampleAggregateFactory
{
    public function createExampleAggregate(): ExampleAggregate;
}
