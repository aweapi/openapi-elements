<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects\SecurityScheme;

use Waspes\Objects\SecurityScheme\OAuth2SecurityScheme;
use Waspes\Tests\Objects\TestCase;

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
            $this->createExtensionMap(['x-foo' => null])
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
