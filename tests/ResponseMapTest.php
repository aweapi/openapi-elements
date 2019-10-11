<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

use TypeError;

final class ResponseMapTest extends TestCase
{
    /**
     * @test
     */
    public function failsOnCreateForInvalidItemName(): void
    {
        $item = $this->createResponse('Example response');
        $items = [0 => $item];
        $this->expectException(TypeError::class);
        $this->createResponseMap($items);
    }

    /**
     * @test
     */
    public function failsOnCreateForNonResponses(): void
    {
        $item = $this->createAbstractDefinition(['x-foo' => 'foo']);
        $items = ['ExampleResponse' => $item];
        $this->expectException(TypeError::class);
        $this->createResponseMap($items);
    }

    /**
     * @test
     */
    public function isCreatedForResponses(): void
    {
        $item = $this->createResponse('Example response');
        $items = ['ExampleResponse' => $item];
        $collection = $this->createResponseMap($items);
        self::assertTrue($collection->hasItems());
        self::assertSame($items, $collection->getItems());
        self::assertJsonObject([
            'ExampleResponse' => ['description' => 'Example response'],
        ], $collection);
    }
}
