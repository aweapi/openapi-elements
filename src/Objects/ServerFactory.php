<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface ServerFactory
{
    public function createServer(): Server;
}
