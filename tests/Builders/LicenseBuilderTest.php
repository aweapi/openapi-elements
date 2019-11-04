<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class LicenseBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();
        $object = $factory->license()
            ->setName('Apache 2.0')
            ->setUrl('https://www.apache.org/licenses/LICENSE-2.0.html')
            ->addExtensions(['x-foo' => null])
            ->createLicense()
        ;
        self::assertJsonObject([
            'name' => 'Apache 2.0',
            'url' => 'https://www.apache.org/licenses/LICENSE-2.0.html',
            'x-foo' => null,
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedWithoutOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();
        $object = $factory->license()
            ->setName('Apache 2.0')
            ->createLicense()
        ;
        self::assertJsonObject([
            'name' => 'Apache 2.0',
        ], $object);
    }
}
