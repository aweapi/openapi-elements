<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface SchemaFactory
{
    public function createSchema(): Schema;
}
