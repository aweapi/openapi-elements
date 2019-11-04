<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders\Properties;

use Aweapi\Openapi\Extensions;

trait OptionalExtensions
{
    private $extensions = [];

    public function addExtensions(iterable $extensions): self
    {
        foreach ($extensions as $name => $value) {
            $this->setExtension($name, $value);
        }

        return $this;
    }

    public function clearExtensions(): self
    {
        $this->extensions = [];

        return $this;
    }

    public function setExtension(string $name, $value): self
    {
        $this->extensions[$name] = $value;

        return $this;
    }

    private function getExtensions(): ?Extensions
    {
        if (empty($this->extensions)) {
            return null;
        }

        return new Extensions($this->extensions);
    }
}
