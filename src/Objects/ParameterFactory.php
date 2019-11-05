<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface ParameterFactory
{
    public function createParameter(): Parameter;
}
