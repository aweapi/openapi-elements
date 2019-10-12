<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Objects;

use Aweapi\Tests\Openapi\TestCase;
use TypeError;

final class CallbackRequestsTest extends TestCase
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
        $this->createCallbackRequests($items);
    }

    /**
     * @test
     */
    public function failsOnCreateForNonExamples(): void
    {
        $item = $this->createAbstractDefinition(['x-foo' => 'foo']);
        $items = ['ExampleCallback' => $item];
        $this->expectException(TypeError::class);
        $this->createCallbackRequests($items);
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
        $collection = $this->createCallbackRequests($items);
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
