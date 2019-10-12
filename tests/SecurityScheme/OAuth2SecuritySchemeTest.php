<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\SecurityScheme;

use Aweapi\Openapi\Objects\SecurityScheme\OAuth2SecurityScheme;
use Aweapi\Tests\Openapi\TestCase;

final class OAuth2SecuritySchemeTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $object = $this->createOAuth2SecurityScheme(
            $this->createOAuthFlows($this->createOAuthFlow([])),
            'Description',
            $this->createExtensions(['x-foo' => null])
        );
        self::assertJsonObject([
            'type' => OAuth2SecurityScheme::TYPE_OAUTH2,
            'flows' => [
                'implicit' => ['scopes' => []],
            ],
            'description' => 'Description',
            'x-foo' => null,
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedWithoutOptionalProperties(): void
    {
        $object = $this->createOAuth2SecurityScheme(
            $this->createOAuthFlows($this->createOAuthFlow([]))
        );
        self::assertJsonObject([
            'type' => OAuth2SecurityScheme::TYPE_OAUTH2,
            'flows' => [
                'implicit' => ['scopes' => []],
            ],
        ], $object);
    }
}
