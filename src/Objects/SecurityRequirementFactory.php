<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface SecurityRequirementFactory
{
    public function createSecurityRequirement(): SecurityRequirement;
}
