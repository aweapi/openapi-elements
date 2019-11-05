<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class MediaTypeBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();
        $object = $factory->mediaType()
            ->setSchema(
                $factory->schema()
                    ->setAttributes(['type' => 'string'])
            )
            ->setExamples(
                $factory->examples()
                    ->setExample('one', $factory->ref()->setHref('#/components/schemas/ExampleOne'))
                    ->setExample('two', $factory->ref()->setHref('#/components/schemas/ExampleTwo'))
            )
            ->setEncodings(
                $factory->encodings()
                    ->setEncoding(
                        'variable',
                        $factory->encoding()
                            ->setContentType('application/json')
                    )
            )
            ->addExtensions(['x-foo' => null])
            ->createMediaType()
        ;
        self::assertJsonObject([
            'schema' => ['type' => 'string'],
            'examples' => [
                'one' => [
                    '$ref' => '#/components/schemas/ExampleOne',
                ],
                'two' => [
                    '$ref' => '#/components/schemas/ExampleTwo',
                ],
            ],
            'encoding' => [
                'variable' => [
                    'contentType' => 'application/json',
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
        $factory = $this->getBuilderFactory();
        $object = $factory->mediaType()
            ->createMediaType()
        ;
        self::assertNull($object->jsonSerialize());
    }
}
