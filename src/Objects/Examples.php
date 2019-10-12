<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

use Aweapi\Openapi\Map;

final class Examples extends Map
{
    private $items = [];

    public function __construct(iterable $examples)
    {
        foreach ($examples as $name => $example) {
            $this->setItem($name, $example);
        }
    }

    /**
     * @return array<string, ExampleAggregate>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    private function setItem(string $name, ExampleAggregate $example): void
    {
        $this->items[$name] = $example;
    }
}
