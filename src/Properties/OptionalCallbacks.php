<?php

declare(strict_types=1);

namespace Waspes\Objects\Properties;

use Waspes\Objects\CallbackRequests;

trait OptionalCallbacks
{
    private $callbacks;

    public function getCallbacks(): CallbackRequests
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
