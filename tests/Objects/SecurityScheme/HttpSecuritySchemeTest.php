<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Objects\SecurityScheme;

use Aweapi\Openapi\Objects\SecurityScheme\HttpSecurityScheme;
use Aweapi\Tests\Openapi\TestCase;

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
            $this->createExtensions(['x-foo' => null])
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
