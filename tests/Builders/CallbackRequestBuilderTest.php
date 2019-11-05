<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class CallbackRequestBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedForPaths(): void
    {
        $factory = $this->getBuilderFactory();
        $map = $factory->callbackRequest()
            ->addItems([
                'https://example.com/?email={$request.body#/email}' => $factory->path()
                    ->setReference($factory->ref()->setHref('#/components/schemas/webhook-path-schema')),
            ])
            ->addExtensions(['x-foo' => null])
            ->createCallbackRequest()
        ;
        self::assertJsonObject([
            'https://example.com/?email={$request.body#/email}' => [
                '$ref' => '#/components/schemas/webhook-path-schema',
            ],
            'x-foo' => null,
        ], $map);
    }

    /**
     * @test
     */
    public function isCreatedWithoutOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();
        $map = $factory->callbackRequest()
            ->createCallbackRequest()
        ;
        self::assertNull($map->jsonSerialize());
    }
}
