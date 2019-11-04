<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class ReferenceBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();
        $href = '#/components/schemas/Foo';
        $object = $factory->ref()
            ->setHref($href)
            ->createReference()
        ;
        self::assertJsonObject([
            '$ref' => $href,
        ], $object);
    }
}
