<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface ParameterCollectionFactory
{
    public function createParameterCollection(): ParameterCollection;
}
