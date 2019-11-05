<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface DiscriminatorFactory
{
    public function createDiscriminator(): Discriminator;
}
