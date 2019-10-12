<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

use Aweapi\Openapi\Extensions;
use Aweapi\Openapi\ValueObject;

final class ServerVariable extends ValueObject
{
    use Properties\OptionalDescription;
    use Properties\OptionalExtensions;

    private $default;

    private $enum;

    public function __construct(
        bool $default,
        array $enum = null,
        string $description = null,
        Extensions $extensions = null
    ) {
        $this->default = $default;
        $this->enum = $enum;
        $this->description = $description;
        $this->extensions = $extensions;
    }

    public function getEnum(): array
    {
        return $this->enum;
    }

    public function hasEnum(): bool
    {
        return isset($this->enum);
    }

    public function isDefault(): bool
    {
        return $this->default;
    }

    public function jsonSerialize(): ?array
    {
        return $this->extendedProperties(parent::jsonSerialize());
    }

    protected function normalizeOptionalProperties(): array
    {
        return [
            'enum' => $this->hasEnum() ? $this->getEnum() : null,
            'description' => $this->getNormalizedDescription(),
        ];
    }

    protected function normalizeRequiredProperties(): array
    {
        return [
            'default' => $this->isDefault(),
        ];
    }
}
