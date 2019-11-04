<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class SchemaBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();
        $schema = $factory->schema()
            ->setAttributes([
                'type' => 'string',
                'format' => 'email',
            ])
            ->addExtensions(['x-foo' => null])
            ->createSchema()
        ;
        self::assertJsonObject([
            'type' => 'string',
            'format' => 'email',
            'x-foo' => null,
        ], $schema);
    }

    /**
     * @test
     */
    public function isCreatedWithoutOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();
        $schema = $factory->schema()
            ->setAttributes([
                'type' => 'string',
                'format' => null,
            ])
            ->createSchema()
        ;
        self::assertJsonObject([
            'type' => 'string',
        ], $schema);
    }
}
