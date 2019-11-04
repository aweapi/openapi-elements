<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class EncodingBuilder implements Objects\EncodingFactory
{
    use Properties\OptionalExtensions;

    private $allowReserved = false;

    private $contentType;

    private $explode = true;

    private $headers;

    private $style;

    public function createEncoding(): Objects\Encoding
    {
        return new Objects\Encoding(
            $this->getContentType(),
            $this->getHeaders() ? $this->getHeaders()->createHeaders() : null,
            $this->getStyle(),
            $this->isExplode(),
            $this->isAllowReserved(),
            $this->getExtensions()
        );
    }

    public function setAllowReserved(bool $allowReserved): self
    {
        $this->allowReserved = $allowReserved;

        return $this;
    }

    public function setContentType(string $contentType): self
    {
        $this->contentType = $contentType;

        return $this;
    }

    public function setExplode(bool $explode): self
    {
        $this->explode = $explode;

        return $this;
    }

    public function setHeaders(Objects\HeadersFactory $headers): self
    {
        $this->headers = $headers;

        return $this;
    }

    public function setStyle(string $style): self
    {
        $this->style = $style;

        return $this;
    }

    private function getContentType(): ?string
    {
        return $this->contentType;
    }

    private function getHeaders(): ?Objects\HeadersFactory
    {
        return $this->headers;
    }

    private function getStyle(): ?string
    {
        return $this->style;
    }

    private function isAllowReserved(): bool
    {
        return $this->allowReserved;
    }

    private function isExplode(): bool
    {
        return $this->explode;
    }
}
