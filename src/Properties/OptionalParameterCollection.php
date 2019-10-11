<?php

declare(strict_types=1);

namespace Waspes\Objects\Properties;

use Waspes\Objects\ParameterCollection;

trait OptionalParameterCollection
{
    private $parameters;

    public function getParameters(): ParameterCollection
    {
        return $this->parameters;
    }

    public function hasParameters(): bool
    {
        return isset($this->parameters);
    }

    private function getNormalizedParameters(): array
    {
        return $this->hasParameters() ? $this->getParameters()->jsonSerialize() : [];
    }
}
