<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface ParametersFactory
{
    public function createParameters(): Parameters;
}
