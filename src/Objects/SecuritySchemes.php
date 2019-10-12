<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

use Aweapi\Openapi\Map;

final class SecuritySchemes extends Map
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
