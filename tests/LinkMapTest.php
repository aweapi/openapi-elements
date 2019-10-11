<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

use TypeError;

final class LinkMapTest extends TestCase
{
    /**
     * @test
     */
    public function failsOnCreateForInvalidItemName(): void
    {
        $item = $this->createLink('readPet');
        $items = [0 => $item];
        $this->expectException(TypeError::class);
        $this->createLinkMap($items);
    }

    /**
     * @test
     */
    public function failsOnCreateForNonLinks(): void
    {
        $item = $this->createAbstractDefinition(['x-foo' => 'foo']);
        $items = ['ExampleLink' => $item];
        $this->expectException(TypeError::class);
        $this->createLinkMap($items);
    }

    /**
     * @test
     */
    public function isCreatedForLinks(): void
    {
        $item = $this->createLink('readPet');
        $items = ['ExampleLink' => $item];
        $collection = $this->createLinkMap($items);
        self::assertTrue($collection->hasItems());
        self::assertSame($items, $collection->getItems());
        self::assertJsonObject([
            'ExampleLink' => [
                'operationId' => 'readPet',
            ],
        ], $collection);
    }
}
