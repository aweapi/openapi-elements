<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

use TypeError;

final class EncodingsTest extends TestCase
{
    /**
     * @test
     */
    public function failsOnCreateForInvalidItemName(): void
    {
        $item = $this->createEncoding('application/json');
        $items = [0 => $item];
        $this->expectException(TypeError::class);
        $this->createEncodings($items);
    }

    /**
     * @test
     */
    public function failsOnCreateForNonEncodings(): void
    {
        $item = $this->createAbstractDefinition(['x-foo' => 'foo']);
        $items = ['variable' => $item];
        $this->expectException(TypeError::class);
        $this->createEncodings($items);
    }

    /**
     * @test
     */
    public function isCreatedForEncodings(): void
    {
        $item = $this->createEncoding('application/json');
        $items = ['variable' => $item];
        $collection = $this->createEncodings($items);
        self::assertTrue($collection->hasItems());
        self::assertSame($items, $collection->getItems());
        self::assertJsonObject([
            'variable' => [
                'contentType' => 'application/json',
            ],
        ], $collection);
    }
}
