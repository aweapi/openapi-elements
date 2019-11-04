<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface ExampleFactory
{
    public function createExample(): Example;
}
