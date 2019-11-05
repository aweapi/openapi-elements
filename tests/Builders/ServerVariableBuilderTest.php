<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class ServerVariableBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();
        $object = $factory->serverVariable()
            ->setDefault(true)
            ->setEnum(['foo'])
            ->setDescription('Description')
            ->addExtensions(['x-foo' => null])
            ->createServerVariable()
        ;
        self::assertJsonObject([
            'default' => true,
            'enum' => ['foo'],
            'description' => 'Description',
            'x-foo' => null,
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedWithoutOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();
        $object = $factory->serverVariable()
            ->setDefault(false)
            ->createServerVariable()
        ;
        self::assertJsonObject([
            'default' => false,
        ], $object);
    }
}
