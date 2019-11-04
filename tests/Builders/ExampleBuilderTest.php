<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class ExampleBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();
        $object = $factory->example()
            ->setSummary('Summary')
            ->setDescription('Description')
            ->setValue('Code')
            ->setExternalValue('https://example.com/code')
            ->addExtensions(['x-foo' => null])
            ->createExample()
        ;
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
        $factory = $this->getBuilderFactory();
        $object = $factory->example()
            ->createExample()
        ;
        self::assertNull($object->jsonSerialize());
    }
}
