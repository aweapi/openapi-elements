<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Objects;

use Aweapi\Tests\Openapi\TestCase;

final class InfoTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $object = $this->createInfo(
            'API',
            '1.0',
            'Description',
            'https://example.com/terms-of-service',
            $this->createContact('API Support'),
            $this->createLicense('MIT'),
            $this->createExtensions(['x-foo' => null])
        );
        self::assertJsonObject([
            'title' => 'API',
            'version' => '1.0',
            'description' => 'Description',
            'termsOfService' => 'https://example.com/terms-of-service',
            'contact' => [
                'name' => 'API Support',
            ],
            'license' => [
                'name' => 'MIT',
            ],
            'x-foo' => null,
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedWithoutOptionalProperties(): void
    {
        $object = $this->createInfo(
            'API',
            '1.0'
        );
        self::assertJsonObject([
            'title' => 'API',
            'version' => '1.0',
        ], $object);
    }
}
