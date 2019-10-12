<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

use Aweapi\Openapi\Map;

final class Headers extends Map
{
    private $items = [];

    public function __construct(iterable $headers)
    {
        foreach ($headers as $name => $header) {
            $this->setItem($name, $header);
        }
    }

    /**
     * @return array<string, HeaderAggregate>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    private function setItem(string $name, HeaderAggregate $header): void
    {
        $this->items[$name] = $header;
    }
}
