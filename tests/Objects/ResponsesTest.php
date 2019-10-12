<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Objects;

use Aweapi\Tests\Openapi\TestCase;
use TypeError;

final class ResponsesTest extends TestCase
{
    /**
     * @test
     */
    public function failsOnCreateForInvalidItemName(): void
    {
        $item = $this->createResponse('Example response');
        $items = [0 => $item];
        $this->expectException(TypeError::class);
        $this->createResponses($items);
    }

    /**
     * @test
     */
    public function failsOnCreateForNonResponses(): void
    {
        $item = $this->createAbstractDefinition(['x-foo' => 'foo']);
        $items = ['ExampleResponse' => $item];
        $this->expectException(TypeError::class);
        $this->createResponses($items);
    }

    /**
     * @test
     */
    public function isCreatedForResponses(): void
    {
        $item = $this->createResponse('Example response');
        $items = ['ExampleResponse' => $item];
        $collection = $this->createResponses($items);
        self::assertTrue($collection->hasItems());
        self::assertSame($items, $collection->getItems());
        self::assertJsonObject([
            'ExampleResponse' => ['description' => 'Example response'],
        ], $collection);
    }
}
