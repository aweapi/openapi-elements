<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class ServerBuilder implements Objects\ServerFactory
{
    use Properties\OptionalExtensions;

    private $description;

    private $url;

    private $variables;

    public function createServer(): Objects\Server
    {
        return new Objects\Server(
            $this->getUrl(),
            $this->getDescription(),
            $this->getVariables() ? $this->getVariables()->createServerVariables() : null,
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

    public function setVariables(Objects\ServerVariablesFactory $variables): self
    {
        $this->variables = $variables;

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

    private function getVariables(): ?Objects\ServerVariablesFactory
    {
        return $this->variables;
    }
}
