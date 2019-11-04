<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface ServerVariableFactory
{
    public function createServerVariable(): ServerVariable;
}
