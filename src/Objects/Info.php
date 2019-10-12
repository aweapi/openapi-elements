<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

use Aweapi\Openapi\Extensions;
use Aweapi\Openapi\ValueObject;

final class Info extends ValueObject
{
    use Properties\OptionalDescription;
    use Properties\OptionalExtensions;

    private $contact;

    private $license;

    private $termsOfService;

    private $title;

    private $version;

    public function __construct(
        string $title,
        string $version,
        string $description = null,
        string $termsOfService = null,
        Contact $contact = null,
        License $license = null,
        Extensions $extensions = null
    ) {
        $this->title = $title;
        $this->version = $version;
        $this->description = $description;
        $this->termsOfService = $termsOfService;
        $this->contact = $contact;
        $this->license = $license;
        $this->extensions = $extensions;
    }

    public function getContact(): Contact
    {
        return $this->contact;
    }

    public function getLicense(): License
    {
        return $this->license;
    }

    public function getTermsOfService(): string
    {
        return $this->termsOfService;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function hasContact(): bool
    {
        return isset($this->contact);
    }

    public function hasLicense(): bool
    {
        return isset($this->license);
    }

    public function hasTermsOfService(): bool
    {
        return isset($this->termsOfService);
    }

    public function jsonSerialize(): ?array
    {
        return $this->extendedProperties(parent::jsonSerialize());
    }

    protected function normalizeOptionalProperties(): array
    {
        return [
            'description' => $this->getNormalizedDescription(),
            'termsOfService' => $this->hasTermsOfService() ? $this->getTermsOfService() : null,
            'contact' => $this->hasContact() ? $this->getContact()->jsonSerialize() : null,
            'license' => $this->hasLicense() ? $this->getLicense()->jsonSerialize() : null,
        ];
    }

    protected function normalizeRequiredProperties(): array
    {
        return [
            'title' => $this->getTitle(),
            'version' => $this->getVersion(),
        ];
    }
}
