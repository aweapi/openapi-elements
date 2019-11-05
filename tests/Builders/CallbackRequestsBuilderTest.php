<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class CallbackRequestsBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedForCallbackRequests(): void
    {
        $factory = $this->getBuilderFactory();
        $map = $factory->callbackRequests()
            ->addCallbacks([
                'ExampleCallback' => $factory->callbackRequest()
                    ->addItems([
                        'https://example.com/?email={$request.body#/email}' => $factory->path()
                            ->setReference($factory->ref()->setHref('#/components/schemas/webhook-path-schema')),
                    ]),
            ])
            ->createCallbackRequests()
        ;
        self::assertJsonObject([
            'ExampleCallback' => [
                'https://example.com/?email={$request.body#/email}' => [
                    '$ref' => '#/components/schemas/webhook-path-schema',
                ],
            ],
        ], $map);
    }
}
