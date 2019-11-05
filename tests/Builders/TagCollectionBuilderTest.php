<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class TagCollectionBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedForTags(): void
    {
        $factory = $this->getBuilderFactory();
        $collection = $factory->tagCollection()
            ->addTags(
                $factory->tag()
                    ->setName('pets')
            )
            ->createTagCollection()
        ;
        self::assertJsonObject([
            ['name' => 'pets'],
        ], $collection);
    }
}
