<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface ParameterFactory extends ParameterAggregateFactory
{
    public function createParameter(): Parameter;
}
