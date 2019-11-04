<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class ResponseBuilder implements Objects\ResponseFactory
{
    use Properties\OptionalExtensions;

    private $content;

    private $description;

    private $headers;

    private $links;

    public function createResponse(): Objects\Response
    {
        return new Objects\Response(
            $this->getDescription(),
            $this->getHeaders() ? $this->getHeaders()->createHeaders() : null,
            $this->getContent() ? $this->getContent()->createMediaTypes() : null,
            $this->getLinks() ? $this->getLinks()->createLinks() : null,
            $this->getExtensions()
        );
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

    public function setHeaders(Objects\HeadersFactory $headers): self
    {
        $this->headers = $headers;

        return $this;
    }

    public function setLinks(Objects\LinksFactory $links): self
    {
        $this->links = $links;

        return $this;
    }

    private function getContent(): ?Objects\MediaTypesFactory
    {
        return $this->content;
    }

    private function getDescription(): string
    {
        return $this->description;
    }

    private function getHeaders(): ?Objects\HeadersFactory
    {
        return $this->headers;
    }

    private function getLinks(): ?Objects\LinksFactory
    {
        return $this->links;
    }
}
