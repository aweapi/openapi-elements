<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

use Aweapi\Openapi\Extensions;
use Aweapi\Openapi\ValueObject;

final class Schema extends ValueObject implements SchemaAggregate
{
    use Properties\OptionalExtensions;

    private $attributes;

    public function __construct(
        array $attributes,
        Extensions $extensions = null
    ) {
        $this->attributes = $attributes;
        $this->extensions = $extensions;
    }

    public function jsonSerialize(): ?array
    {
        return $this->extendedProperties(parent::jsonSerialize());
    }

    protected function normalizeOptionalProperties(): array
    {
        return $this->attributes;
    }
}
