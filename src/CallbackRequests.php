<?php

declare(strict_types=1);

namespace Waspes\Objects;

final class CallbackRequests extends Map
{
    private $items = [];

    public function __construct(iterable $callbacks)
    {
        foreach ($callbacks as $name => $callback) {
            $this->setItem($name, $callback);
        }
    }

    /**
     * @return array<string, CallbackRequest>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    private function setItem(string $name, CallbackRequest $callback): void
    {
        $this->items[$name] = $callback;
    }
}
