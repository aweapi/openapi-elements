<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

use TypeError;

final class HeadersTest extends TestCase
{
    /**
     * @test
     */
    public function failsOnCreateForInvalidItemName(): void
    {
        $item = $this->createHeader();
        $items = [0 => $item];
        $this->expectException(TypeError::class);
        $this->createHeaders($items);
    }

    /**
     * @test
     */
    public function failsOnCreateForNonHeaders(): void
    {
        $item = $this->createAbstractDefinition(['x-foo' => 'foo']);
        $items = ['ExampleHeader' => $item];
        $this->expectException(TypeError::class);
        $this->createHeaders($items);
    }

    /**
     * @test
     */
    public function isCreatedForHeaders(): void
    {
        $item = $this->createHeader($this->createSchema(['type' => 'string']));
        $items = ['ExampleHeader' => $item];
        $collection = $this->createHeaders($items);
        self::assertTrue($collection->hasItems());
        self::assertSame($items, $collection->getItems());
        self::assertJsonObject([
            'ExampleHeader' => [
                'schema' => ['type' => 'string'],
            ],
        ], $collection);
    }
}
