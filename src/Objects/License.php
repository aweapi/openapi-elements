<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

use Aweapi\Openapi\Extensions;
use Aweapi\Openapi\ValueObject;

final class License extends ValueObject
{
    use Properties\OptionalExtensions;
    use Properties\OptionalUrl;

    private $name;

    public function __construct(
        string $name,
        string $url = null,
        Extensions $extensions = null
    ) {
        $this->name = $name;
        $this->url = $url;
        $this->extensions = $extensions;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function jsonSerialize(): ?array
    {
        return $this->extendedProperties(parent::jsonSerialize());
    }

    protected function normalizeOptionalProperties(): array
    {
        return [
            'url' => $this->getNormalizedUrl(),
        ];
    }

    protected function normalizeRequiredProperties(): array
    {
        return [
            'name' => $this->getName(),
        ];
    }
}
