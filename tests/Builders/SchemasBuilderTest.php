<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class SchemasBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedForSchemas(): void
    {
        $factory = $this->getBuilderFactory();
        $map = $factory->schemas()
            ->addSchemas([
                'ExampleResponse' => $factory->schema()
                    ->setAttributes(['type' => 'object']),
            ])
            ->createSchemas()
        ;
        self::assertJsonObject([
            'ExampleResponse' => ['type' => 'object'],
        ], $map);
    }
}
