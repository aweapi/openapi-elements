<?php

declare(strict_types=1);

namespace Waspes\Objects\SecurityScheme;

use Waspes\Objects\ExtensionMap;
use Waspes\Objects\SecurityScheme;

final class HttpSecurityScheme extends SecurityScheme
{
    private $bearerFormat;

    private $scheme;

    public function __construct(
        string $scheme,
        string $bearerFormat = null,
        string $description = null,
        ExtensionMap $extensions = null
    ) {
        parent::__construct(
            SecurityScheme::TYPE_HTTP,
            $description,
            $extensions
        );
        $this->scheme = $scheme;
        $this->bearerFormat = $bearerFormat;
    }

    public function getBearerFormat(): string
    {
        return $this->bearerFormat;
    }

    public function getScheme(): string
    {
        return $this->scheme;
    }

    public function hasBearerFormat(): bool
    {
        return isset($this->bearerFormat);
    }

    protected function normalizeOptionalSchemeProperties(): array
    {
        return [
            'bearerFormat' => $this->hasBearerFormat() ? $this->getBearerFormat() : null,
        ];
    }

    protected function normalizeRequiredSchemeProperties(): array
    {
        return [
            'scheme' => $this->getScheme(),
        ];
    }
}
