<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

use Aweapi\Openapi\Map;

final class Encodings extends Map
{
    private $items = [];

    public function __construct(iterable $encodings)
    {
        foreach ($encodings as $name => $encoding) {
            $this->setItem($name, $encoding);
        }
    }

    /**
     * @return array<string, Encoding>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    private function setItem(string $name, Encoding $encoding): void
    {
        $this->items[$name] = $encoding;
    }
}
