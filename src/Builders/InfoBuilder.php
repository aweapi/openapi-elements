<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class InfoBuilder implements Objects\InfoFactory
{
    use Properties\OptionalExtensions;

    private $contact;

    private $description;

    private $license;

    private $termsOfService;

    private $title;

    private $version;

    public function createInfo(): Objects\Info
    {
        return new Objects\Info(
            $this->getTitle(),
            $this->getVersion(),
            $this->getDescription(),
            $this->getTermsOfService(),
            $this->getContact() ? $this->getContact()->createContact() : null,
            $this->getLicense() ? $this->getLicense()->createLicense() : null,
            $this->getExtensions()
        );
    }

    public function setContact(Objects\ContactFactory $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setLicense(Objects\LicenseFactory $license): self
    {
        $this->license = $license;

        return $this;
    }

    public function setTermsOfService(string $termsOfService): self
    {
        $this->termsOfService = $termsOfService;

        return $this;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
    }

    private function getContact(): ?Objects\ContactFactory
    {
        return $this->contact;
    }

    private function getDescription(): ?string
    {
        return $this->description;
    }

    private function getLicense(): ?Objects\LicenseFactory
    {
        return $this->license;
    }

    private function getTermsOfService(): ?string
    {
        return $this->termsOfService;
    }

    private function getTitle(): string
    {
        return $this->title;
    }

    private function getVersion(): string
    {
        return $this->version;
    }
}
