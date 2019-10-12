<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi;

use ArrayIterator;
use Aweapi\Openapi\Collection;

final class CollectionTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedFromArray(): void
    {
        $item = $this->createAbstractDefinition(['bar' => 'baz']);
        $collection = $this->createCollection([$item]);
        self::assertTrue($collection->hasItems());
        self::assertSame([$item], $collection->getItems());
        self::assertJsonObject([
            ['bar' => 'baz'],
        ], $collection);
    }

    /**
     * @test
     */
    public function isCreatedFromIterator(): void
    {
        $item = $this->createAbstractDefinition(['bar' => 'baz']);
        $collection = $this->createCollection(new ArrayIterator([$item]));
        self::assertTrue($collection->hasItems());
        self::assertSame([$item], $collection->getItems());
        self::assertJsonObject([
            ['bar' => 'baz'],
        ], $collection);
    }

    /**
     * @test
     */
    public function isIterableAndCountable(): void
    {
        $item = $this->createAbstractDefinition(null);
        $collection = $this->createCollection([$item]);
        self::assertCount(1, $collection);
        self::assertSame(1, iterator_count($collection));
    }

    /**
     * @test
     */
    public function skipsEmptyItems(): void
    {
        $item = $this->createAbstractDefinition(null);
        $collection = $this->createCollection([$item]);
        $list = $collection->jsonSerialize();
        self::assertEmpty($list);
    }

    private function createCollection(iterable $items): Collection
    {
        return new class($items) extends Collection {
            private $items = [];

            public function __construct(iterable $items = [])
            {
                foreach ($items as $item) {
                    $this->items[] = $item;
                }
            }

            public function getItems(): array
            {
                return $this->items;
            }
        };
    }
}
