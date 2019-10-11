<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

final class ResponseTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $object = $this->createResponse(
            'Description',
            $this->createHeaderMap([
                'Content-Type' => $this->createHeader($this->createSchema(['type' => 'string'])),
            ]),
            $this->createMediaTypeMap([]),
            $this->createLinkMap([]),
            $this->createExtensionMap(['x-foo' => null])
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
