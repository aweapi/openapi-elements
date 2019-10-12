<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

use Aweapi\Openapi\Extensions;
use Aweapi\Openapi\ValueObject;

final class OAuthFlow extends ValueObject
{
    use Properties\OptionalExtensions;

    private $authorizationUrl;

    private $refreshUrl;

    private $scopes = [];

    private $tokenUrl;

    public function __construct(
        iterable $scopes,
        string $authorizationUrl = null,
        string $tokenUrl = null,
        string $refreshUrl = null,
        Extensions $extensions = null
    ) {
        foreach ($scopes as $name => $shortDescription) {
            $name = $this->filterString($name);
            $shortDescription = $this->filterString($shortDescription);
            $this->scopes[$name] = $shortDescription;
        }

        $this->authorizationUrl = $authorizationUrl;
        $this->tokenUrl = $tokenUrl;
        $this->refreshUrl = $refreshUrl;
        $this->extensions = $extensions;
    }

    public function getAuthorizationUrl(): string
    {
        return $this->authorizationUrl;
    }

    public function getRefreshUrl(): string
    {
        return $this->refreshUrl;
    }

    public function getScopes(): array
    {
        return $this->scopes;
    }

    public function getTokenUrl(): string
    {
        return $this->tokenUrl;
    }

    public function hasAuthorizationUrl(): bool
    {
        return isset($this->authorizationUrl);
    }

    public function hasRefreshUrl(): bool
    {
        return isset($this->refreshUrl);
    }

    public function hasTokenUrl(): bool
    {
        return isset($this->tokenUrl);
    }

    public function jsonSerialize(): ?array
    {
        return $this->extendedProperties(parent::jsonSerialize());
    }

    protected function normalizeOptionalProperties(): array
    {
        return [
            'authorizationUrl' => $this->hasAuthorizationUrl() ? $this->getAuthorizationUrl() : null,
            'tokenUrl' => $this->hasTokenUrl() ? $this->getTokenUrl() : null,
            'refreshUrl' => $this->hasRefreshUrl() ? $this->getRefreshUrl() : null,
        ];
    }

    protected function normalizeRequiredProperties(): array
    {
        return [
            'scopes' => $this->getScopes(),
        ];
    }

    private function filterString(string $value): string
    {
        return $value;
    }
}
