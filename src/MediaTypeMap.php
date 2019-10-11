<?php

declare(strict_types=1);

namespace Waspes\Objects;

final class MediaTypeMap extends Map
{
    private $items = [];

    public function __construct(iterable $mediaTypes)
    {
        foreach ($mediaTypes as $contentType => $mediaType) {
            $this->setItem($contentType, $mediaType);
        }
    }

    /**
     * @return array<string, MediaType>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    private function setItem(string $contentType, MediaType $mediaType): void
    {
        $this->items[$contentType] = $mediaType;
    }
}
