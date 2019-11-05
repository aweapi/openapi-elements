<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface ComponentsFactory
{
    public function createComponents(): Components;
}
