<?php

declare(strict_types=1);

namespace Waspes\Objects;

final class ExternalDocumentation extends ValueObject
{
    use Properties\Url;
    use Properties\OptionalDescription;
    use Properties\OptionalExtensions;

    public function __construct(
        string $url,
        string $description = null,
        ExtensionMap $extensions = null
    ) {
        $this->url = $url;
        $this->description = $description;
        $this->extensions = $extensions;
    }

    public function jsonSerialize(): ?array
    {
        return $this->extendedProperties(parent::jsonSerialize());
    }

    protected function normalizeOptionalProperties(): array
    {
        return [
            'description' => $this->getNormalizedDescription(),
        ];
    }

    protected function normalizeRequiredProperties(): array
    {
        return [
            'url' => $this->getUrl(),
        ];
    }
}
