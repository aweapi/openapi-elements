<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface RequestBodiesFactory
{
    public function createRequestBodies(): RequestBodies;
}
