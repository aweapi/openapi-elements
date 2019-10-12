<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\SecurityScheme;

use Aweapi\Openapi\Objects\SecurityScheme\ApiKeySecurityScheme;
use Aweapi\Tests\Openapi\TestCase;

final class ApiKeySecuritySchemeTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $object = $this->createApiKeySecurityScheme(
            'api_key',
            'header',
            'Description',
            $this->createExtensions(['x-foo' => null])
        );
        self::assertJsonObject([
            'type' => ApiKeySecurityScheme::TYPE_API_KEY,
            'name' => 'api_key',
            'in' => 'header',
            'description' => 'Description',
            'x-foo' => null,
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedWithoutOptionalProperties(): void
    {
        $object = $this->createApiKeySecurityScheme(
            'api_key',
            'header'
        );
        self::assertJsonObject([
            'type' => ApiKeySecurityScheme::TYPE_API_KEY,
            'name' => 'api_key',
            'in' => 'header',
        ], $object);
    }
}
