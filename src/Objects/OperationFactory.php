<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface OperationFactory
{
    public function createOperation(): Operation;
}
