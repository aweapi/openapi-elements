<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

use TypeError;

final class CallbackRequestMapTest extends TestCase
{
    /**
     * @test
     */
    public function failsOnCreateForInvalidItemName(): void
    {
        $item = $this->createCallbackRequest(
            [
                'https://example.com/?email={$request.body#/email}' => $this->createPath(
                    null,
                    $this->createReference('#/components/schemas/webhook-path-schema')
                ),
            ]
        );
        $items = [0 => $item];
        $this->expectException(TypeError::class);
        $this->createCallbackRequestMap($items);
    }

    /**
     * @test
     */
    public function failsOnCreateForNonExamples(): void
    {
        $item = $this->createAbstractDefinition(['x-foo' => 'foo']);
        $items = ['ExampleCallback' => $item];
        $this->expectException(TypeError::class);
        $this->createCallbackRequestMap($items);
    }

    /**
     * @test
     */
    public function isCreatedForExamples(): void
    {
        $item = $this->createCallbackRequest(
            [
                'https://example.com/?email={$request.body#/email}' => $this->createPath(
                    null,
                    $this->createReference('#/components/schemas/webhook-path-schema')
                ),
            ]
        );
        $items = ['ExampleCallback' => $item];
        $collection = $this->createCallbackRequestMap($items);
        self::assertTrue($collection->hasItems());
        self::assertSame($items, $collection->getItems());
        self::assertJsonObject([
            'ExampleCallback' => [
                'https://example.com/?email={$request.body#/email}' => [
                    '$ref' => '#/components/schemas/webhook-path-schema',
                ],
            ],
        ], $collection);
    }
}
