<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects\Properties;

use Aweapi\Openapi\Objects\SecurityRequirementCollection;

trait OptionalSecurityRequirements
{
    private $security;

    public function getSecurity(): SecurityRequirementCollection
    {
        return $this->security;
    }

    public function hasSecurity(): bool
    {
        return isset($this->security);
    }

    private function getNormalizedSecurity(): array
    {
        return $this->hasSecurity() ? $this->getSecurity()->jsonSerialize() : [];
    }
}
