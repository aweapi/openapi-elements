<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

use TypeError;

final class ExamplesTest extends TestCase
{
    /**
     * @test
     */
    public function failsOnCreateForInvalidItemName(): void
    {
        $item = $this->createExample('Example');
        $items = [0 => $item];
        $this->expectException(TypeError::class);
        $this->createExamples($items);
    }

    /**
     * @test
     */
    public function failsOnCreateForNonExamples(): void
    {
        $item = $this->createAbstractDefinition(['x-foo' => 'foo']);
        $items = ['ExampleExample' => $item];
        $this->expectException(TypeError::class);
        $this->createExamples($items);
    }

    /**
     * @test
     */
    public function isCreatedForExamples(): void
    {
        $item = $this->createExample('Example');
        $items = ['ExampleExample' => $item];
        $collection = $this->createExamples($items);
        self::assertTrue($collection->hasItems());
        self::assertSame($items, $collection->getItems());
        self::assertJsonObject([
            'ExampleExample' => ['summary' => 'Example'],
        ], $collection);
    }
}
