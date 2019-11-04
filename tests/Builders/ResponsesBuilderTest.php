<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class ResponsesBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedForResponses(): void
    {
        $factory = $this->getBuilderFactory();
        $map = $factory->responses()
            ->addResponses([
                'ExampleResponse' => $factory->response()
                    ->setDescription('Example response'),
            ])
            ->createResponses()
        ;
        self::assertJsonObject([
            'ExampleResponse' => ['description' => 'Example response'],
        ], $map);
    }
}
