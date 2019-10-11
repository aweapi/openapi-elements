<?php

declare(strict_types=1);

namespace Waspes\Objects;

final class SecurityRequirement extends ValueObject
{
    private $items = [];

    public function __construct(iterable $requirements)
    {
        foreach ($requirements as $name => $requirement) {
            $this->setItem($name, $requirement);
        }
    }

    /**
     * @return array<string, array>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    protected function normalizeRequiredProperties(): array
    {
        return $this->getItems();
    }

    private function setItem(string $name, array $requirement): void
    {
        $this->items[$name] = array_map(
            function (string $scope): string {
                return $scope;
            },
            $requirement
        );
    }
}
