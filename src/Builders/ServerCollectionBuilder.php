<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class ServerCollectionBuilder implements Objects\ServerCollectionFactory
{
    private $servers = [];

    public function addServers(Objects\ServerFactory ...$servers): self
    {
        foreach ($servers as $server) {
            $this->servers[] = $server;
        }

        return $this;
    }

    public function createServerCollection(): Objects\ServerCollection
    {
        return new Objects\ServerCollection(
            array_map(
                static function (Objects\ServerFactory $factory): Objects\Server {
                    return $factory->createServer();
                },
                $this->getServers()
            )
        );
    }

    private function getServers(): array
    {
        return $this->servers;
    }
}
