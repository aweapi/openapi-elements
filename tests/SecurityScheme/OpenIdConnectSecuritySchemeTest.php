<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects\SecurityScheme;

use Waspes\Objects\SecurityScheme\OpenIdConnectSecurityScheme;
use Waspes\Tests\Objects\TestCase;

final class OpenIdConnectSecuritySchemeTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $object = $this->createOpenIdConnectSecurityScheme(
            'https://example.com/api/oauth',
            'Description',
            $this->createExtensions(['x-foo' => null])
        );
        self::assertJsonObject([
            'type' => OpenIdConnectSecurityScheme::TYPE_OPEN_ID_CONNECT,
            'openIdConnectUrl' => 'https://example.com/api/oauth',
            'description' => 'Description',
            'x-foo' => null,
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedWithoutOptionalProperties(): void
    {
        $object = $this->createOpenIdConnectSecurityScheme(
            'https://example.com/api/oauth'
        );
        self::assertJsonObject([
            'type' => OpenIdConnectSecurityScheme::TYPE_OPEN_ID_CONNECT,
            'openIdConnectUrl' => 'https://example.com/api/oauth',
        ], $object);
    }
}
