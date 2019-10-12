<?php

declare(strict_types=1);

namespace Waspes\Objects;

final class ServerVariables extends Map
{
    private $items = [];

    public function __construct(iterable $variables)
    {
        foreach ($variables as $name => $variable) {
            $this->setItem($name, $variable);
        }
    }

    /**
     * @return array<string, ServerVariable>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    private function setItem(string $name, ServerVariable $variable): void
    {
        $this->items[$name] = $variable;
    }
}
