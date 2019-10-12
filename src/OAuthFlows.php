<?php

declare(strict_types=1);

namespace Waspes\Objects;

final class OAuthFlows extends ValueObject
{
    use Properties\OptionalExtensions;

    private $authorizationCode;

    private $clientCredentials;

    private $implicit;

    private $password;

    public function __construct(
        OAuthFlow $implicit = null,
        OAuthFlow $password = null,
        OAuthFlow $clientCredentials = null,
        OAuthFlow $authorizationCode = null,
        Extensions $extensions = null
    ) {
        $this->implicit = $implicit;
        $this->password = $password;
        $this->clientCredentials = $clientCredentials;
        $this->authorizationCode = $authorizationCode;
        $this->extensions = $extensions;
    }

    public function getAuthorizationCode(): OAuthFlow
    {
        return $this->authorizationCode;
    }

    public function getClientCredentials(): OAuthFlow
    {
        return $this->clientCredentials;
    }

    public function getImplicit(): OAuthFlow
    {
        return $this->implicit;
    }

    public function getPassword(): OAuthFlow
    {
        return $this->password;
    }

    public function hasAuthorizationCode(): bool
    {
        return isset($this->authorizationCode);
    }

    public function hasClientCredentials(): bool
    {
        return isset($this->clientCredentials);
    }

    public function hasImplicit(): bool
    {
        return isset($this->implicit);
    }

    public function hasPassword(): bool
    {
        return isset($this->password);
    }

    public function jsonSerialize(): ?array
    {
        return $this->extendedProperties(parent::jsonSerialize());
    }

    protected function normalizeOptionalProperties(): array
    {
        return [
            'implicit' => $this->hasImplicit() ? $this->getImplicit()->jsonSerialize() : null,
            'password' => $this->hasPassword() ? $this->getPassword()->jsonSerialize() : null,
            'clientCredentials' => $this->hasClientCredentials() ? $this->getClientCredentials()->jsonSerialize() : null,
            'authorizationCode' => $this->hasAuthorizationCode() ? $this->getAuthorizationCode()->jsonSerialize() : null,
        ];
    }
}
