<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

final class ContactTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $object = $this->createContact(
            'API Support',
            'https://www.example.com/support',
            'support@example.com',
            $this->createExtensionMap(['x-foo' => null])
        );
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
        $object = $this->createContact();
        self::assertNull($object->jsonSerialize());
    }
}
