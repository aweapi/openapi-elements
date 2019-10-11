<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

use TypeError;

final class HeaderMapTest extends TestCase
{
    /**
     * @test
     */
    public function failsOnCreateForInvalidItemName(): void
    {
        $item = $this->createHeader();
        $items = [0 => $item];
        $this->expectException(TypeError::class);
        $this->createHeaderMap($items);
    }

    /**
     * @test
     */
    public function failsOnCreateForNonHeaders(): void
    {
        $item = $this->createAbstractDefinition(['x-foo' => 'foo']);
        $items = ['ExampleHeader' => $item];
        $this->expectException(TypeError::class);
        $this->createHeaderMap($items);
    }

    /**
     * @test
     */
    public function isCreatedForHeaders(): void
    {
        $item = $this->createHeader($this->createSchema(['type' => 'string']));
        $items = ['ExampleHeader' => $item];
        $collection = $this->createHeaderMap($items);
        self::assertTrue($collection->hasItems());
        self::assertSame($items, $collection->getItems());
        self::assertJsonObject([
            'ExampleHeader' => [
                'schema' => ['type' => 'string'],
            ],
        ], $collection);
    }
}
