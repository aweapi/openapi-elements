<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface PathFactory
{
    public function createPath(): Path;
}
