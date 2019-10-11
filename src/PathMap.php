<?php

declare(strict_types=1);

namespace Waspes\Objects;

final class PathMap extends ValueObject
{
    use Properties\OptionalExtensions;

    private $paths = [];

    public function __construct(
        iterable $paths,
        ExtensionMap $extensions = null
    ) {
        foreach ($paths as $urlPath => $path) {
            $this->setPath($urlPath, $path);
        }

        $this->extensions = $extensions;
    }

    public function getPath(string $path): Path
    {
        return $this->paths[$path];
    }

    /**
     * @return Path[]
     */
    public function getPaths(): array
    {
        return $this->paths;
    }

    public function hasPath(string $path): bool
    {
        return isset($this->paths[$path]);
    }

    public function jsonSerialize(): ?array
    {
        return $this->extendedProperties(parent::jsonSerialize());
    }

    protected function normalizeOptionalProperties(): array
    {
        $paths = [];
        foreach ($this->getPaths() as $pathUrl => $path) {
            $paths[$pathUrl] = $path->jsonSerialize();
        }

        return $paths;
    }

    private function setPath(string $urlPath, Path $path): void
    {
        $this->paths[$urlPath] = $path;
    }
}
