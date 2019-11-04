<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class ExternalDocumentationBuilder implements Objects\ExternalDocumentationFactory
{
    use Properties\OptionalExtensions;

    private $description;

    private $url;

    public function createExternalDocumentation(): Objects\ExternalDocumentation
    {
        return new Objects\ExternalDocumentation(
            $this->getUrl(),
            $this->getDescription(),
            $this->getExtensions()
        );
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    private function getDescription(): ?string
    {
        return $this->description;
    }

    private function getUrl(): string
    {
        return $this->url;
    }
}
