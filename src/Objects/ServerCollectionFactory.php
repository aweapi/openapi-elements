<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface ServerCollectionFactory
{
    public function createServerCollection(): ServerCollection;
}
