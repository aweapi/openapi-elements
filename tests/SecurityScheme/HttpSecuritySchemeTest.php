<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects\SecurityScheme;

use Waspes\Objects\SecurityScheme\HttpSecurityScheme;
use Waspes\Tests\Objects\TestCase;

final class HttpSecuritySchemeTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $object = $this->createHttpSecurityScheme(
            'basic',
            'JWT',
            'Description',
            $this->createExtensionMap(['x-foo' => null])
        );
        self::assertJsonObject([
            'type' => HttpSecurityScheme::TYPE_HTTP,
            'scheme' => 'basic',
            'description' => 'Description',
            'bearerFormat' => 'JWT',
            'x-foo' => null,
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedWithoutOptionalProperties(): void
    {
        $object = $this->createHttpSecurityScheme(
            'basic'
        );
        self::assertJsonObject([
            'type' => HttpSecurityScheme::TYPE_HTTP,
            'scheme' => 'basic',
        ], $object);
    }
}
