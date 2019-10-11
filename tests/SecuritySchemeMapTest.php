<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

use TypeError;
use Waspes\Objects\SecurityScheme\ApiKeySecurityScheme;

final class SecuritySchemeMapTest extends TestCase
{
    /**
     * @test
     */
    public function failsOnCreateForInvalidItemName(): void
    {
        $item = $this->createApiKeySecurityScheme('api_key', 'header');
        $items = [0 => $item];
        $this->expectException(TypeError::class);
        $this->createSecuritySchemeMap($items);
    }

    /**
     * @test
     */
    public function failsOnCreateForNonResponses(): void
    {
        $item = $this->createAbstractDefinition(['x-foo' => 'foo']);
        $items = ['ExampleSecurityScheme' => $item];
        $this->expectException(TypeError::class);
        $this->createSecuritySchemeMap($items);
    }

    /**
     * @test
     */
    public function isCreatedForResponses(): void
    {
        $item = $this->createApiKeySecurityScheme('api_key', 'header');
        $items = ['ExampleSecurityScheme' => $item];
        $collection = $this->createSecuritySchemeMap($items);
        self::assertTrue($collection->hasItems());
        self::assertSame($items, $collection->getItems());
        self::assertJsonObject([
            'ExampleSecurityScheme' => [
                'type' => ApiKeySecurityScheme::TYPE_API_KEY,
                'name' => 'api_key',
                'in' => 'header',
            ],
        ], $collection);
    }
}
