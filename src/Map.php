<?php

declare(strict_types=1);

namespace Waspes\Objects;

use ArrayIterator;
use Countable;
use Iterator;
use IteratorAggregate;

abstract class Map implements Definition, Countable, IteratorAggregate
{
    final public function count(): int
    {
        return count($this->getItems());
    }

    abstract public function getItems(): array;

    final public function getIterator(): Iterator
    {
        return new ArrayIterator($this->getItems());
    }

    final public function hasItems(): bool
    {
        return $this->count() > 0;
    }

    public function jsonSerialize(): ?array
    {
        $values = [];
        foreach ($this->getItems() as $key => $item) {
            $value = $item->jsonSerialize();
            if ($value) {
                $values[$key] = $value;
            }
        }

        if (empty($values)) {
            return null;
        }

        return $values;
    }
}
