<?php

declare(strict_types=1);

namespace Waspes\Objects\Properties;

trait OptionalDescription
{
    use Description;

    public function hasDescription(): bool
    {
        return isset($this->description);
    }

    private function getNormalizedDescription(): ?string
    {
        return $this->hasDescription() ? $this->getDescription() : null;
    }
}
