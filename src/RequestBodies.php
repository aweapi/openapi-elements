<?php

declare(strict_types=1);

namespace Waspes\Objects;

final class RequestBodies extends Map
{
    private $items = [];

    public function __construct(iterable $requestBodies)
    {
        foreach ($requestBodies as $name => $requestBody) {
            $this->setItem($name, $requestBody);
        }
    }

    /**
     * @return array<string, RequestBodyAggregate>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    private function setItem(string $name, RequestBodyAggregate $requestBody): void
    {
        $this->items[$name] = $requestBody;
    }
}
