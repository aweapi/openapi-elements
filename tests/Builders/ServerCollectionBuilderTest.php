<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class ServerCollectionBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedForServers(): void
    {
        $factory = $this->getBuilderFactory();
        $collection = $factory->serverCollection()
            ->addServers(
                $factory->server()
                    ->setUrl('/')
            )
            ->createServerCollection()
        ;
        self::assertJsonObject([
            ['url' => '/'],
        ], $collection);
    }
}
