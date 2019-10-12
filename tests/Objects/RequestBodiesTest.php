<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Objects;

use Aweapi\Tests\Openapi\TestCase;
use stdClass;
use TypeError;

final class RequestBodiesTest extends TestCase
{
    /**
     * @test
     */
    public function failsOnCreateForInvalidItemName(): void
    {
        $item = $this->createRequestBody($this->createMediaTypes([]));
        $items = [0 => $item];
        $this->expectException(TypeError::class);
        $this->createRequestBodies($items);
    }

    /**
     * @test
     */
    public function failsOnCreateForNonRequestBodies(): void
    {
        $item = $this->createAbstractDefinition(['x-foo' => 'foo']);
        $items = ['ExampleRequest' => $item];
        $this->expectException(TypeError::class);
        $this->createRequestBodies($items);
    }

    /**
     * @test
     */
    public function isCreatedForRequestBodies(): void
    {
        $item = $this->createRequestBody($this->createMediaTypes([]));
        $items = ['ExampleRequest' => $item];
        $collection = $this->createRequestBodies($items);
        self::assertTrue($collection->hasItems());
        self::assertSame($items, $collection->getItems());
        self::assertJsonObject([
            'ExampleRequest' => ['content' => new stdClass()],
        ], $collection);
    }
}
