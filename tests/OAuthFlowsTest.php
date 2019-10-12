<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

final class OAuthFlowsTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $object = $this->createOAuthFlows(
            $this->createOAuthFlow(['read' => 'implicit']),
            $this->createOAuthFlow(['read' => 'password']),
            $this->createOAuthFlow(['read' => 'clientCredentials']),
            $this->createOAuthFlow(['read' => 'authorizationCode']),
            $this->createExtensions(['x-foo' => null])
        );
        self::assertJsonObject([
            'implicit' => ['scopes' => ['read' => 'implicit']],
            'password' => ['scopes' => ['read' => 'password']],
            'clientCredentials' => ['scopes' => ['read' => 'clientCredentials']],
            'authorizationCode' => ['scopes' => ['read' => 'authorizationCode']],
            'x-foo' => null,
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedWithoutOptionalProperties(): void
    {
        $object = $this->createOAuthFlows();
        self::assertNull($object->jsonSerialize());
    }
}
