<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface SchemasFactory
{
    public function createSchemas(): Schemas;
}
