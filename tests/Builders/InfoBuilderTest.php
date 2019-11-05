<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class InfoBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();
        $object = $factory->info()
            ->setTitle('API')
            ->setVersion('1.0')
            ->setDescription('Description')
            ->setTermsOfService('https://example.com/terms-of-service')
            ->setContact(
                $factory->contact()
                    ->setName('API Support')
            )
            ->setLicense(
                $factory->license()
                    ->setName('MIT')
            )
            ->addExtensions(['x-foo' => null])
            ->createInfo()
        ;
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
        $factory = $this->getBuilderFactory();
        $object = $factory->info()
            ->setTitle('API')
            ->setVersion('1.0')
            ->createInfo()
        ;
        self::assertJsonObject([
            'title' => 'API',
            'version' => '1.0',
        ], $object);
    }
}
