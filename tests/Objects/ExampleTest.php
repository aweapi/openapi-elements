<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Objects;

use Aweapi\Tests\Openapi\TestCase;

final class ExampleTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $object = $this->createExample(
            'Summary',
            'Description',
            'Code',
            'https://example.com/code',
            $this->createExtensions(['x-foo' => null])
        );
        self::assertJsonObject([
            'summary' => 'Summary',
            'description' => 'Description',
            'value' => 'Code',
            'externalValue' => 'https://example.com/code',
            'x-foo' => null,
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedWithoutOptionalProperties(): void
    {
        $object = $this->createExample();
        self::assertNull($object->jsonSerialize());
    }
}
