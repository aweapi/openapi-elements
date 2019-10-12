<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

use Aweapi\Openapi\Map;

final class Links extends Map
{
    private $items = [];

    public function __construct(iterable $links)
    {
        foreach ($links as $name => $link) {
            $this->setItem($name, $link);
        }
    }

    /**
     * @return array<string, LinkAggregate>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    private function setItem(string $name, LinkAggregate $links): void
    {
        $this->items[$name] = $links;
    }
}
