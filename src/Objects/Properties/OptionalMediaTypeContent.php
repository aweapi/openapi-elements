<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects\Properties;

trait OptionalMediaTypeContent
{
    use MediaTypeContent;

    public function hasContent(): bool
    {
        return isset($this->content);
    }

    private function getNormalizedContent(): ?array
    {
        return $this->hasContent() ? $this->getContent()->jsonSerialize() : null;
    }
}
