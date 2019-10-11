<?php

declare(strict_types=1);

namespace Waspes\Objects\Properties;

trait OptionalServers
{
    use Servers;

    public function hasServers(): bool
    {
        return isset($this->servers);
    }

    private function getNormalizedServers(): ?array
    {
        return $this->hasServers() ? $this->getServers()->jsonSerialize() : null;
    }
}
