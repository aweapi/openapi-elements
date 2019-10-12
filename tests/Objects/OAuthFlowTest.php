<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Objects;

use Aweapi\Tests\Openapi\TestCase;

final class OAuthFlowTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $object = $this->createOAuthFlow(
            [
                'write:pets' => 'modify pets in your account',
                'read:pets' => 'read your pets',
            ],
            'https://example.com/api/oauth/dialog',
            'https://example.com/api/oauth/token',
            'https://example.com/api/oauth/refresh',
            $this->createExtensions(['x-foo' => null])
        );
        self::assertJsonObject([
            'scopes' => [
                'write:pets' => 'modify pets in your account',
                'read:pets' => 'read your pets',
            ],
            'authorizationUrl' => 'https://example.com/api/oauth/dialog',
            'tokenUrl' => 'https://example.com/api/oauth/token',
            'refreshUrl' => 'https://example.com/api/oauth/refresh',
            'x-foo' => null,
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedWithoutOptionalProperties(): void
    {
        $object = $this->createOAuthFlow(
            [
                'write:pets' => 'modify pets in your account',
                'read:pets' => 'read your pets',
            ]
        );
        self::assertJsonObject([
            'scopes' => [
                'write:pets' => 'modify pets in your account',
                'read:pets' => 'read your pets',
            ],
        ], $object);
    }
}
