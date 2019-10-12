<?php

declare(strict_types=1);

namespace Waspes\Objects;

final class Responses extends Map
{
    private $items = [];

    public function __construct(iterable $responses)
    {
        foreach ($responses as $name => $response) {
            $this->setItem($name, $response);
        }
    }

    /**
     * @return array<string, ResponseAggregate>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    private function setItem(string $name, ResponseAggregate $response): void
    {
        $this->items[$name] = $response;
    }
}
