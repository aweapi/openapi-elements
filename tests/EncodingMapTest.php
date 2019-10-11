<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

use TypeError;

final class EncodingMapTest extends TestCase
{
    /**
     * @test
     */
    public function failsOnCreateForInvalidItemName(): void
    {
        $item = $this->createEncoding('application/json');
        $items = [0 => $item];
        $this->expectException(TypeError::class);
        $this->createEncodingMap($items);
    }

    /**
     * @test
     */
    public function failsOnCreateForNonEncodings(): void
    {
        $item = $this->createAbstractDefinition(['x-foo' => 'foo']);
        $items = ['variable' => $item];
        $this->expectException(TypeError::class);
        $this->createEncodingMap($items);
    }

    /**
     * @test
     */
    public function isCreatedForEncodings(): void
    {
        $item = $this->createEncoding('application/json');
        $items = ['variable' => $item];
        $collection = $this->createEncodingMap($items);
        self::assertTrue($collection->hasItems());
        self::assertSame($items, $collection->getItems());
        self::assertJsonObject([
            'variable' => [
                'contentType' => 'application/json',
            ],
        ], $collection);
    }
}
