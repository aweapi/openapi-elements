<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class SecurityRequirementCollectionBuilder implements Objects\SecurityRequirementCollectionFactory
{
    private $securityRequirements = [];

    public function addSecurityRequirements(Objects\SecurityRequirementFactory ...$securityRequirements): self
    {
        foreach ($securityRequirements as $securityRequirement) {
            $this->securityRequirements[] = $securityRequirement;
        }

        return $this;
    }

    public function createSecurityRequirementCollection(): Objects\SecurityRequirementCollection
    {
        return new Objects\SecurityRequirementCollection(
            array_map(
                static function (Objects\SecurityRequirementFactory $factory): Objects\SecurityRequirement {
                    return $factory->createSecurityRequirement();
                },
                $this->getSecurityRequirements()
            )
        );
    }

    private function getSecurityRequirements(): array
    {
        return $this->securityRequirements;
    }
}
