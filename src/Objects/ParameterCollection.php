<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

use Aweapi\Openapi\Collection;

final class ParameterCollection extends Collection
{
    private $items = [];

    public function __construct(iterable $items = [])
    {
        foreach ($items as $item) {
            $this->addItem($item);
        }
    }

    /**
     * @return array<int, Parameter>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    private function addItem(Parameter $item): void
    {
        $this->items[] = $item;
    }
}
