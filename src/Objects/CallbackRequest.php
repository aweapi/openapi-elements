<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

use Aweapi\Openapi\Extensions;
use Aweapi\Openapi\Map;

final class CallbackRequest extends Map
{
    use Properties\OptionalExtensions;

    private $items = [];

    public function __construct(
        iterable $items,
        Extensions $extensions = null
    ) {
        foreach ($items as $expression => $path) {
            $this->setItem($expression, $path);
        }

        $this->extensions = $extensions;
    }

    /**
     * @return array<string, Path>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function jsonSerialize(): ?array
    {
        return $this->extendedProperties(parent::jsonSerialize());
    }

    private function setItem(string $expression, Path $path): void
    {
        $this->items[$expression] = $path;
    }
}
