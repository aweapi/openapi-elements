<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

final class ReferenceTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithLink(): void
    {
        $href = '#/components/schemas/Foo';
        $object = $this->createReference($href);
        self::assertJsonObject([
            '$ref' => $href,
        ], $object);
    }
}
