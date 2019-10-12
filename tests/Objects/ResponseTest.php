<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Objects;

use Aweapi\Tests\Openapi\TestCase;

final class ResponseTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $object = $this->createResponse(
            'Description',
            $this->createHeaders([
                'Content-Type' => $this->createHeader($this->createSchema(['type' => 'string'])),
            ]),
            $this->createMediaTypes([]),
            $this->createLinks([]),
            $this->createExtensions(['x-foo' => null])
        );
        self::assertJsonObject([
            'description' => 'Description',
            'headers' => [
                'Content-Type' => [
                    'schema' => ['type' => 'string'],
                ],
            ],
            'x-foo' => null,
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedWithoutOptionalProperties(): void
    {
        $object = $this->createResponse(
            'Description'
        );
        self::assertJsonObject([
            'description' => 'Description',
        ], $object);
    }
}
