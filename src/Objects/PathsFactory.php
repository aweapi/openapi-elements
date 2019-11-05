<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface PathsFactory
{
    public function createPaths(): Paths;
}
