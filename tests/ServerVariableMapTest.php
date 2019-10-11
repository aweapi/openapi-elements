<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

use TypeError;

final class ServerVariableMapTest extends TestCase
{
    /**
     * @test
     */
    public function failsOnCreateForInvalidItemName(): void
    {
        $item = $this->createServerVariable(true);
        $items = [0 => $item];
        $this->expectException(TypeError::class);
        $this->createServerVariableMap($items);
    }

    /**
     * @test
     */
    public function failsOnCreateForNonVariables(): void
    {
        $item = $this->createAbstractDefinition(['x-foo' => 'foo']);
        $items = ['id' => $item];
        $this->expectException(TypeError::class);
        $this->createServerVariableMap($items);
    }

    /**
     * @test
     */
    public function isCreatedForVariables(): void
    {
        $item = $this->createServerVariable(true);
        $items = ['id' => $item];
        $collection = $this->createServerVariableMap($items);
        self::assertTrue($collection->hasItems());
        self::assertSame($items, $collection->getItems());
        self::assertJsonObject([
            'id' => ['default' => true],
        ], $collection);
    }
}
