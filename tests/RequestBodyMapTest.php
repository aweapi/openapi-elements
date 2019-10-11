<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

use stdClass;
use TypeError;

final class RequestBodyMapTest extends TestCase
{
    /**
     * @test
     */
    public function failsOnCreateForInvalidItemName(): void
    {
        $item = $this->createRequestBody($this->createMediaTypeMap([]));
        $items = [0 => $item];
        $this->expectException(TypeError::class);
        $this->createRequestBodyMap($items);
    }

    /**
     * @test
     */
    public function failsOnCreateForNonRequestBodies(): void
    {
        $item = $this->createAbstractDefinition(['x-foo' => 'foo']);
        $items = ['ExampleRequest' => $item];
        $this->expectException(TypeError::class);
        $this->createRequestBodyMap($items);
    }

    /**
     * @test
     */
    public function isCreatedForRequestBodies(): void
    {
        $item = $this->createRequestBody($this->createMediaTypeMap([]));
        $items = ['ExampleRequest' => $item];
        $collection = $this->createRequestBodyMap($items);
        self::assertTrue($collection->hasItems());
        self::assertSame($items, $collection->getItems());
        self::assertJsonObject([
            'ExampleRequest' => ['content' => new stdClass()],
        ], $collection);
    }
}
