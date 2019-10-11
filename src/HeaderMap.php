<?php

declare(strict_types=1);

namespace Waspes\Objects;

final class HeaderMap extends Map
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
