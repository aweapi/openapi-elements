<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class ContactBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();
        $object = $factory->contact()
            ->setName('API Support')
            ->setUrl('https://www.example.com/support')
            ->setEmail('support@example.com')
            ->addExtensions(['x-foo' => null])
            ->createContact()
        ;
        self::assertJsonObject([
            'name' => 'API Support',
            'url' => 'https://www.example.com/support',
            'email' => 'support@example.com',
            'x-foo' => null,
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedWithoutOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();
        $object = $factory->contact()
            ->createContact()
        ;
        self::assertNull($object->jsonSerialize());
    }
}
