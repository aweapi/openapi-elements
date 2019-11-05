<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class TagBuilder implements Objects\TagFactory
{
    use Properties\OptionalExtensions;

    private $description;

    private $externalDocs;

    private $name;

    public function createTag(): Objects\Tag
    {
        return new Objects\Tag(
            $this->getName(),
            $this->getDescription(),
            $this->getExternalDocs() ? $this->getExternalDocs()->createExternalDocumentation() : null,
            $this->getExtensions()
        );
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setExternalDocs(Objects\ExternalDocumentationFactory $externalDocs): self
    {
        $this->externalDocs = $externalDocs;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    private function getDescription(): ?string
    {
        return $this->description;
    }

    private function getExternalDocs(): ?Objects\ExternalDocumentationFactory
    {
        return $this->externalDocs;
    }

    private function getName(): string
    {
        return $this->name;
    }
}
