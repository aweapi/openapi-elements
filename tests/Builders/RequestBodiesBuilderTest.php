<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;
use stdClass;

final class RequestBodiesBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedForRequestBodies(): void
    {
        $factory = $this->getBuilderFactory();
        $map = $factory->requestBodies()
            ->addRequestBodies([
                'ExampleRequest' => $factory->requestBody()
                    ->setContent(
                        $factory->mediaTypes()
                    ),
            ])
            ->createRequestBodies()
        ;
        self::assertJsonObject([
            'ExampleRequest' => ['content' => new stdClass()],
        ], $map);
    }
}
