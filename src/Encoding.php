<?php

declare(strict_types=1);

namespace Waspes\Objects;

final class Encoding extends ValueObject
{
    use Properties\OptionalExtensions;

    private $allowReserved;

    private $contentType;

    private $explode;

    private $headers;

    private $style;

    public function __construct(
        string $contentType = null,
        HeaderMap $headers = null,
        string $style = null,
        bool $explode = true,
        bool $allowReserved = false,
        ExtensionMap $extensions = null
    ) {
        $this->contentType = $contentType;
        $this->headers = $headers;
        $this->style = $style;
        $this->explode = $explode;
        $this->allowReserved = $allowReserved;
        $this->extensions = $extensions;
    }

    public function getContentType(): string
    {
        return $this->contentType;
    }

    public function getHeaders(): HeaderMap
    {
        return $this->headers;
    }

    public function getStyle(): string
    {
        return $this->style;
    }

    public function hasContentType(): bool
    {
        return isset($this->contentType);
    }

    public function hasHeaders(): bool
    {
        return isset($this->headers);
    }

    public function hasStyle(): bool
    {
        return isset($this->style);
    }

    public function isAllowReserved(): bool
    {
        return $this->allowReserved;
    }

    public function isExplode(): bool
    {
        return $this->explode;
    }

    public function jsonSerialize(): ?array
    {
        return $this->extendedProperties(parent::jsonSerialize());
    }

    protected function normalizeOptionalProperties(): array
    {
        return [
            'contentType' => $this->hasContentType() ? $this->getContentType() : null,
            'headers' => $this->hasHeaders() ? $this->getHeaders()->jsonSerialize() : null,
            'style' => $this->hasStyle() ? $this->getStyle() : null,
            'explode' => $this->isExplode() ? null : false,
            'allowReserved' => $this->isAllowReserved() ?: null,
        ];
    }
}
