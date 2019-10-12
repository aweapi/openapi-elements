<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

final class ServerVariableTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $object = $this->createServerVariable(
            true,
            ['foo'],
            'Description',
            $this->createExtensions(['x-foo' => null])
        );
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
        $object = $this->createServerVariable(false);
        self::assertJsonObject([
            'default' => false,
        ], $object);
    }
}
