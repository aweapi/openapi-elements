<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class ExamplesBuilder implements Objects\ExamplesFactory
{
    private $examples = [];

    public function addExamples(iterable $variables): self
    {
        foreach ($variables as $key => $variable) {
            $this->setExample($key, $variable);
        }

        return $this;
    }

    public function createExamples(): Objects\Examples
    {
        return new Objects\Examples(
            array_map(
                static function (Objects\ExampleFactory $factory): Objects\Example {
                    return $factory->createExample();
                },
                $this->getExamples()
            )
        );
    }

    public function setExample(string $name, Objects\ExampleFactory $example): self
    {
        $this->examples[$name] = $example;

        return $this;
    }

    private function getExamples(): array
    {
        return $this->examples;
    }
}
