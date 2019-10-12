<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects\Properties;

use Aweapi\Openapi\Objects\ServerCollection;

trait Servers
{
    private $servers;

    public function getServers(): ServerCollection
    {
        return $this->servers;
    }

    private function getNormalizedServers(): array
    {
        return $this->getServers()->jsonSerialize();
    }
}
