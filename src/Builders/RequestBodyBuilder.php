<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class RequestBodyBuilder implements Objects\RequestBodyFactory
{
    use Properties\OptionalExtensions;

    private $content;

    private $description;

    private $required = false;

    public function createRequestBody(): Objects\RequestBody
    {
        return new Objects\RequestBody(
            $this->getContent()->createMediaTypes(),
            $this->getDescription(),
            $this->isRequired(),
            $this->getExtensions()
        );
    }

    public function createRequestBodyAggregate(): Objects\RequestBodyAggregate
    {
        return $this->createRequestBody();
    }

    public function setContent(Objects\MediaTypesFactory $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setRequired(bool $required): self
    {
        $this->required = $required;

        return $this;
    }

    private function getContent(): Objects\MediaTypesFactory
    {
        return $this->content;
    }

    private function getDescription(): ?string
    {
        return $this->description;
    }

    private function isRequired(): bool
    {
        return $this->required;
    }
}
