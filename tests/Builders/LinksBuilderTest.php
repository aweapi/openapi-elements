<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class LinksBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedForLinks(): void
    {
        $factory = $this->getBuilderFactory();
        $links = $factory->links()
            ->addLinks([
                'ExampleLink' => $factory->link()
                    ->setOperationId('readPet'),
            ])
            ->createLinks()
        ;
        self::assertJsonObject([
            'ExampleLink' => [
                'operationId' => 'readPet',
            ],
        ], $links);
    }
}
