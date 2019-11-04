<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class EncodingsBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedForEncodings(): void
    {
        $factory = $this->getBuilderFactory();
        $map = $factory->encodings()
            ->addEncodings([
                'variable' => $factory->encoding()
                    ->setContentType('application/json'),
            ])
            ->createEncodings()
        ;
        self::assertJsonObject([
            'variable' => [
                'contentType' => 'application/json',
            ],
        ], $map);
    }
}
