<?php

declare(strict_types=1);

namespace Waspes\Objects;

final class Schemas extends Map
{
    private $items = [];

    public function __construct(iterable $schemas)
    {
        foreach ($schemas as $name => $response) {
            $this->setItem($name, $response);
        }
    }

    /**
     * @return array<string, SchemaAggregate>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    private function setItem(string $name, SchemaAggregate $schema): void
    {
        $this->items[$name] = $schema;
    }
}
