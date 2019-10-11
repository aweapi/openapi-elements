<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

final class CallbackRequestTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $object = $this->createCallbackRequest(
            [
                'https://example.com/?email={$request.body#/email}' => $this->createPath(
                    null,
                    $this->createReference('#/components/schemas/webhook-path-schema')
                ),
            ],
            $this->createExtensionMap(['x-foo' => null])
        );
        self::assertJsonObject([
            'https://example.com/?email={$request.body#/email}' => [
                '$ref' => '#/components/schemas/webhook-path-schema',
            ],
            'x-foo' => null,
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedWithoutOptionalProperties(): void
    {
        $object = $this->createCallbackRequest([]);
        self::assertNull($object->jsonSerialize());
    }
}
