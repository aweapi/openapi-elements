<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class HeadersBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedForLinks(): void
    {
        $factory = $this->getBuilderFactory();
        $map = $factory->headers()
            ->addHeaders([
                'ExampleHeader' => $factory->header()
                    ->setSchema(
                        $factory->schema()
                            ->setAttributes(['type' => 'string'])
                    ),
            ])
            ->createHeaders()
        ;
        self::assertJsonObject([
            'ExampleHeader' => [
                'schema' => ['type' => 'string'],
            ],
        ], $map);
    }
}
