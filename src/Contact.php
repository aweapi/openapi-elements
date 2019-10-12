<?php

declare(strict_types=1);

namespace Waspes\Objects;

final class Contact extends ValueObject
{
    use Properties\OptionalExtensions;
    use Properties\OptionalUrl;

    private $email;

    private $name;

    public function __construct(
        string $name = null,
        string $url = null,
        string $email = null,
        Extensions $extensions = null
    ) {
        $this->name = $name;
        $this->url = $url;
        $this->email = $email;
        $this->extensions = $extensions;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function hasEmail(): bool
    {
        return isset($this->email);
    }

    public function hasName(): bool
    {
        return isset($this->name);
    }

    public function jsonSerialize(): ?array
    {
        return $this->extendedProperties(parent::jsonSerialize());
    }

    protected function normalizeOptionalProperties(): array
    {
        return [
            'name' => $this->hasName() ? $this->getName() : null,
            'url' => $this->getNormalizedUrl(),
            'email' => $this->hasEmail() ? $this->getEmail() : null,
        ];
    }
}
