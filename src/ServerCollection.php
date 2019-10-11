<?php

declare(strict_types=1);

namespace Waspes\Objects;

final class ServerCollection extends Collection
{
    private $items = [];

    public function __construct(iterable $items = [])
    {
        foreach ($items as $item) {
            $this->addItem($item);
        }
    }

    /**
     * @return array<int, Server>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    private function addItem(Server $item): void
    {
        $this->items[] = $item;
    }
}
