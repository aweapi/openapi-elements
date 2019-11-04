<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface LinkFactory
{
    public function createLink(): Link;
}
