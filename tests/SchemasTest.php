<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

use TypeError;

final class SchemasTest extends TestCase
{
    /**
     * @test
     */
    public function failsOnCreateForInvalidItemName(): void
    {
        $item = $this->createSchema([]);
        $items = [0 => $item];
        $this->expectException(TypeError::class);
        $this->createSchemas($items);
    }

    /**
     * @test
     */
    public function failsOnCreateForNonSchema(): void
    {
        $item = $this->createAbstractDefinition(['x-foo' => 'foo']);
        $items = ['ExampleSchema' => $item];
        $this->expectException(TypeError::class);
        $this->createSchemas($items);
    }

    /**
     * @test
     */
    public function isCreatedForResponses(): void
    {
        $item = $this->createSchema(['type' => 'object']);
        $items = ['ExampleResponse' => $item];
        $collection = $this->createSchemas($items);
        self::assertTrue($collection->hasItems());
        self::assertSame($items, $collection->getItems());
        self::assertJsonObject([
            'ExampleResponse' => ['type' => 'object'],
        ], $collection);
    }
}
