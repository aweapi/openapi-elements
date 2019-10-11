<?php

declare(strict_types=1);

namespace Waspes\Objects\Properties;

use Waspes\Objects\CallbackRequestMap;

trait OptionalCallbacks
{
    private $callbacks;

    public function getCallbacks(): CallbackRequestMap
    {
        return $this->callbacks;
    }

    public function hasCallbacks(): bool
    {
        return isset($this->callbacks);
    }

    private function getNormalizedCallbacks(): ?array
    {
        return $this->hasCallbacks() ? $this->getCallbacks()->jsonSerialize() : null;
    }
}
