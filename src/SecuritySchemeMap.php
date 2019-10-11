<?php

declare(strict_types=1);

namespace Waspes\Objects;

final class SecuritySchemeMap extends Map
{
    private $items = [];

    public function __construct(iterable $securitySchemes)
    {
        foreach ($securitySchemes as $name => $securityScheme) {
            $this->setItem($name, $securityScheme);
        }
    }

    /**
     * @return array<string, SecuritySchemeAggregate>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    private function setItem(string $name, SecuritySchemeAggregate $securityScheme): void
    {
        $this->items[$name] = $securityScheme;
    }
}
