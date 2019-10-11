<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

final class ServerTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $object = $this->createServer(
            'https://example.com',
            'Description',
            $this->createServerVariableMap(['id' => $this->createServerVariable(true)]),
            $this->createExtensionMap(['x-foo' => null])
        );
        self::assertJsonObject([
            'url' => 'https://example.com',
            'description' => 'Description',
            'variables' => [
                'id' => ['default' => true],
            ],
            'x-foo' => null,
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedWithoutOptionalProperties(): void
    {
        $object = $this->createServer(
            'https://example.com'
        );
        self::assertJsonObject([
            'url' => 'https://example.com',
        ], $object);
    }
}
