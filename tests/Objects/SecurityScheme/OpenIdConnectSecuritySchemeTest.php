<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Objects\SecurityScheme;

use Aweapi\Openapi\Objects\SecurityScheme\OpenIdConnectSecurityScheme;
use Aweapi\Tests\Openapi\TestCase;

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
