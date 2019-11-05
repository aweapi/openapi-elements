<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class ExamplesBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedForExamples(): void
    {
        $factory = $this->getBuilderFactory();
        $examples = $factory->examples()
            ->addExamples([
                'ExampleExample' => $factory->example()
                    ->setSummary('Example'),
            ])
            ->createExamples()
        ;
        self::assertJsonObject([
            'ExampleExample' => ['summary' => 'Example'],
        ], $examples);
    }
}
