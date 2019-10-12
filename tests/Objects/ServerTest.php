<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Objects;

use Aweapi\Tests\Openapi\TestCase;

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
            $this->createServerVariables(['id' => $this->createServerVariable(true)]),
            $this->createExtensions(['x-foo' => null])
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
