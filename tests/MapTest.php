<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

use ArrayIterator;
use Waspes\Objects\Map;

final class MapTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedFromArray(): void
    {
        $item = $this->createAbstractDefinition(['bar' => 'baz']);
        $items = ['foo' => $item];
        $map = $this->createMap($items);
        self::assertTrue($map->hasItems());
        self::assertSame($items, $map->getItems());
        self::assertJsonObject([
            'foo' => ['bar' => 'baz'],
        ], $map);
    }

    /**
     * @test
     */
    public function isCreatedFromIterator(): void
    {
        $item = $this->createAbstractDefinition(['bar' => 'baz']);
        $items = ['foo' => $item];
        $map = $this->createMap(new ArrayIterator($items));
        self::assertTrue($map->hasItems());
        self::assertSame($items, $map->getItems());
        self::assertJsonObject([
            'foo' => ['bar' => 'baz'],
        ], $map);
    }

    /**
     * @test
     */
    public function isIterableAndCountable(): void
    {
        $item = $this->createAbstractDefinition(null);
        $items = ['key' => $item];
        $map = $this->createMap($items);
        self::assertCount(1, $map);
        self::assertSame(1, iterator_count($map));
    }

    /**
     * @test
     */
    public function serializesToNullIfIsEmpty(): void
    {
        $map = $this->createMap([]);
        self::assertNull($map->jsonSerialize());

        $item = $this->createAbstractDefinition(null);
        $items = ['foo' => $item];
        $map = $this->createMap($items);
        self::assertNull($map->jsonSerialize());
    }

    /**
     * @test
     */
    public function skipsEmptyItems(): void
    {
        $item1 = $this->createAbstractDefinition(null);
        $item2 = $this->createAbstractDefinition(['foo' => 'bar']);
        $items = ['empty' => $item1, 'filled' => $item2];
        $map = $this->createMap($items);
        self::assertJsonObject([
            'filled' => ['foo' => 'bar'],
        ], $map);
    }

    private function createMap(iterable $items): Map
    {
        return new class($items) extends Map {
            private $items = [];

            public function __construct(iterable $items = [])
            {
                foreach ($items as $key => $item) {
                    $this->items[$key] = $item;
                }
            }

            public function getItems(): array
            {
                return $this->items;
            }
        };
    }
}
