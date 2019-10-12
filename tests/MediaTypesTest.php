<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

use TypeError;

final class MediaTypesTest extends TestCase
{
    /**
     * @test
     */
    public function failsOnCreateForInvalidItemName(): void
    {
        $item = $this->createMediaType($this->createSchema(['type' => 'object']));
        $items = [0 => $item];
        $this->expectException(TypeError::class);
        $this->createMediaTypes($items);
    }

    /**
     * @test
     */
    public function failsOnCreateForNonExamples(): void
    {
        $item = $this->createAbstractDefinition(['x-foo' => 'foo']);
        $items = ['ExampleMediaType' => $item];
        $this->expectException(TypeError::class);
        $this->createMediaTypes($items);
    }

    /**
     * @test
     */
    public function isCreatedForExamples(): void
    {
        $item = $this->createMediaType($this->createSchema(['type' => 'object']));
        $items = ['ExampleMediaType' => $item];
        $collection = $this->createMediaTypes($items);
        self::assertTrue($collection->hasItems());
        self::assertSame($items, $collection->getItems());
        self::assertJsonObject([
            'ExampleMediaType' => ['schema' => ['type' => 'object']],
        ], $collection);
    }
}
