<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface TagCollectionFactory
{
    public function createTagCollection(): TagCollection;
}
