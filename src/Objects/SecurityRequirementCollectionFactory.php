<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface SecurityRequirementCollectionFactory
{
    public function createSecurityRequirementCollection(): SecurityRequirementCollection;
}
