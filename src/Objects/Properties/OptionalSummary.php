<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects\Properties;

trait OptionalSummary
{
    private $summary;

    public function getSummary(): string
    {
        return $this->summary;
    }

    public function hasSummary(): bool
    {
        return isset($this->summary);
    }

    private function getNormalizedSummary(): ?string
    {
        return $this->hasSummary() ? $this->getSummary() : null;
    }
}
