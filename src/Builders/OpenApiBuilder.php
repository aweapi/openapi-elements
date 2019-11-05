<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class OpenApiBuilder implements Objects\OpenApiFactory
{
    use Properties\OptionalExtensions;

    private $components;

    private $externalDocs;

    private $info;

    private $openapi;

    private $paths;

    private $security;

    private $servers;

    private $tags;

    public function createOpenApi(): Objects\OpenApi
    {
        return new Objects\OpenApi(
            $this->getOpenapi(),
            $this->getInfo()->createInfo(),
            $this->getPaths()->createPaths(),
            $this->getServers() ? $this->getServers()->createServerCollection() : null,
            $this->getComponents() ? $this->getComponents()->createComponents() : null,
            $this->getSecurity() ? $this->getSecurity()->createSecurityRequirementCollection() : null,
            $this->getTags() ? $this->getTags()->createTagCollection() : null,
            $this->getExternalDocs() ? $this->getExternalDocs()->createExternalDocumentation() : null,
            $this->getExtensions()
        );
    }

    public function setComponents(Objects\ComponentsFactory $components): self
    {
        $this->components = $components;

        return $this;
    }

    public function setExternalDocs(Objects\ExternalDocumentationFactory $externalDocs): self
    {
        $this->externalDocs = $externalDocs;

        return $this;
    }

    public function setInfo(Objects\InfoFactory $infoFactory): self
    {
        $this->info = $infoFactory;

        return $this;
    }

    public function setOpenapi(string $openapi): self
    {
        $this->openapi = $openapi;

        return $this;
    }

    public function setPaths(Objects\PathsFactory $pathsFactory): self
    {
        $this->paths = $pathsFactory;

        return $this;
    }

    public function setSecurity(Objects\SecurityRequirementCollectionFactory $security): self
    {
        $this->security = $security;

        return $this;
    }

    public function setServers(Objects\ServerCollectionFactory $servers): self
    {
        $this->servers = $servers;

        return $this;
    }

    public function setTags(Objects\TagCollectionFactory $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    private function getComponents(): ?Objects\ComponentsFactory
    {
        return $this->components;
    }

    private function getExternalDocs(): ?Objects\ExternalDocumentationFactory
    {
        return $this->externalDocs;
    }

    private function getInfo(): Objects\InfoFactory
    {
        return $this->info;
    }

    private function getOpenapi(): string
    {
        return $this->openapi;
    }

    private function getPaths(): Objects\PathsFactory
    {
        return $this->paths;
    }

    private function getSecurity(): ?Objects\SecurityRequirementCollectionFactory
    {
        return $this->security;
    }

    private function getServers(): ?Objects\ServerCollectionFactory
    {
        return $this->servers;
    }

    private function getTags(): ?Objects\TagCollectionFactory
    {
        return $this->tags;
    }
}
