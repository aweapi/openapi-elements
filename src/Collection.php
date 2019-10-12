<?php

declare(strict_types=1);

namespace Aweapi\Openapi;

use ArrayIterator;
use Countable;
use Iterator;
use IteratorAggregate;

abstract class Collection implements Definition, Countable, IteratorAggregate
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

    final public function jsonSerialize(): array
    {
        $values = [];
        foreach ($this->getItems() as $item) {
            $value = $item->jsonSerialize();
            if ($value) {
                $values[] = $value;
            }
        }

        return $values;
    }
}
