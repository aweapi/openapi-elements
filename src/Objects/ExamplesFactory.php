<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface ExamplesFactory
{
    public function createExamples(): Examples;
}
