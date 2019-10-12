<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects\Properties;

trait OptionalUrl
{
    use Url;

    public function hasUrl(): bool
    {
        return isset($this->url);
    }

    private function getNormalizedUrl(): ?string
    {
        return $this->hasUrl() ? $this->getUrl() : null;
    }
}
