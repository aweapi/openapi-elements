<?php

declare(strict_types=1);

namespace Waspes\Objects\Properties;

use Waspes\Objects\ExampleMap;

trait OptionalExamples
{
    private $examples;

    public function getExamples(): ExampleMap
    {
        return $this->examples;
    }

    public function hasExamples(): bool
    {
        return isset($this->examples);
    }

    private function getNormalizedExamples(): ?array
    {
        return $this->hasExamples() ? $this->getExamples()->jsonSerialize() : null;
    }
}
