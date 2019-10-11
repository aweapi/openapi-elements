<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects\SecurityScheme;

use Waspes\Objects\SecurityScheme\ApiKeySecurityScheme;
use Waspes\Tests\Objects\TestCase;

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
            $this->createExtensionMap(['x-foo' => null])
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
