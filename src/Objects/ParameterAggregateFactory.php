<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface ParameterAggregateFactory
{
    public function createParameterAggregate(): ParameterAggregate;
}
