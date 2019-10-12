<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects\Properties;

use Aweapi\Openapi\Objects\Examples;

trait OptionalExamples
{
    private $examples;

    public function getExamples(): Examples
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
