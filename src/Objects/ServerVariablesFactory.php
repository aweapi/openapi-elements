<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface ServerVariablesFactory
{
    public function createServerVariables(): ServerVariables;
}
