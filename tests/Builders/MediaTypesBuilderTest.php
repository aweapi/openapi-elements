<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class MediaTypesBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedForMediaTypes(): void
    {
        $factory = $this->getBuilderFactory();
        $map = $factory->mediaTypes()
            ->addMediaTypes([
                'ExampleMediaType' => $factory->mediaType()
                    ->setSchema(
                        $factory->schema()
                            ->setAttributes(['type' => 'object'])
                    ),
            ])
            ->createMediaTypes()
        ;
        self::assertJsonObject([
            'ExampleMediaType' => ['schema' => ['type' => 'object']],
        ], $map);
    }
}
