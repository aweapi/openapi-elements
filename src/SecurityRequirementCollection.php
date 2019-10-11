<?php

declare(strict_types=1);

namespace Waspes\Objects;

final class SecurityRequirementCollection extends Collection
{
    private $items = [];

    public function __construct(iterable $items = [])
    {
        foreach ($items as $item) {
            $this->addItem($item);
        }
    }

    /**
     * @return array<int, SecurityRequirement>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    private function addItem(SecurityRequirement $item): void
    {
        $this->items[] = $item;
    }
}
