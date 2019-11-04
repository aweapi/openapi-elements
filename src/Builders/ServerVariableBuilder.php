<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class ServerVariableBuilder implements Objects\ServerVariableFactory
{
    use Properties\OptionalExtensions;

    private $default;

    private $description;

    private $enum;

    public function createServerVariable(): Objects\ServerVariable
    {
        return new Objects\ServerVariable(
            $this->isDefault(),
            $this->getEnum(),
            $this->getDescription(),
            $this->getExtensions()
        );
    }

    public function setDefault(bool $default): self
    {
        $this->default = $default;

        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setEnum(array $enum): self
    {
        $this->enum = $enum;

        return $this;
    }

    private function getDescription(): ?string
    {
        return $this->description;
    }

    private function getEnum(): ?array
    {
        return $this->enum;
    }

    private function isDefault(): bool
    {
        return $this->default;
    }
}
