<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface ExampleFactory extends ExampleAggregateFactory
{
    public function createExample(): Example;
}
