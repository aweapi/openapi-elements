<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class PathsBuilder implements Objects\PathsFactory
{
    use Properties\OptionalExtensions;

    private $paths = [];

    public function addPaths(iterable $paths): self
    {
        foreach ($paths as $urlPath => $path) {
            $this->setPath($urlPath, $path);
        }

        return $this;
    }

    public function createPaths(): Objects\Paths
    {
        return new Objects\Paths(
            array_map(
                static function (Objects\PathFactory $factory): Objects\Path {
                    return $factory->createPath();
                },
                $this->getPaths()
            ),
            $this->getExtensions()
        );
    }

    public function setPath(string $urlPath, Objects\PathFactory $path): self
    {
        $this->paths[$urlPath] = $path;

        return $this;
    }

    private function getPaths(): array
    {
        return $this->paths;
    }
}
