<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Objects;

use Aweapi\Tests\Openapi\TestCase;

final class EncodingTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $object = $this->createEncoding(
            'application/json',
            $this->createHeaders([
                'Rate-Limiting' => $this->createHeader($this->createSchema(['type' => 'integer'])),
            ]),
            'form',
            false,
            true,
            $this->createExtensions(['x-foo' => null])
        );
        self::assertJsonObject([
            'contentType' => 'application/json',
            'headers' => [
                'Rate-Limiting' => [
                    'schema' => ['type' => 'integer'],
                ],
            ],
            'style' => 'form',
            'explode' => false,
            'allowReserved' => true,
            'x-foo' => null,
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedWithoutOptionalProperties(): void
    {
        $object = $this->createEncoding();
        self::assertNull($object->jsonSerialize());
    }
}
