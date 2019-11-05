<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class LicenseBuilder implements Objects\LicenseFactory
{
    use Properties\OptionalExtensions;

    private $name;

    private $url;

    public function createLicense(): Objects\License
    {
        return new Objects\License(
            $this->getName(),
            $this->getUrl(),
            $this->getExtensions()
        );
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    private function getName(): string
    {
        return $this->name;
    }

    private function getUrl(): ?string
    {
        return $this->url;
    }
}
