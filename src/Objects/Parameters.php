<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

use Aweapi\Openapi\Map;

final class Parameters extends Map
{
    private $items = [];

    public function __construct(iterable $parameters)
    {
        foreach ($parameters as $name => $parameter) {
            $this->setItem($name, $parameter);
        }
    }

    /**
     * @return array<string, ParameterAggregate>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    private function setItem(string $name, ParameterAggregate $response): void
    {
        $this->items[$name] = $response;
    }
}
