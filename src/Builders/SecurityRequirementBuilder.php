<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class SecurityRequirementBuilder implements Objects\SecurityRequirementFactory
{
    private $items = [];

    public function addItems(iterable $variables): self
    {
        foreach ($variables as $key => $requirement) {
            $this->setItem($key, $requirement);
        }

        return $this;
    }

    public function createSecurityRequirement(): Objects\SecurityRequirement
    {
        return new Objects\SecurityRequirement(
            $this->getItems()
        );
    }

    public function setItem(string $name, array $requirement): self
    {
        $this->items[$name] = array_map(
            function (string $scope): string {
                return $scope;
            },
            $requirement
        );

        return $this;
    }

    private function getItems(): iterable
    {
        return $this->items;
    }
}
