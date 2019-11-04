<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class LinksBuilder implements Objects\LinksFactory
{
    private $links = [];

    public function addLinks(iterable $links): self
    {
        foreach ($links as $name => $link) {
            $this->setLink($name, $link);
        }

        return $this;
    }

    public function createLinks(): Objects\Links
    {
        return new Objects\Links(
            array_map(
                static function (Objects\LinkFactory $factory): Objects\Link {
                    return $factory->createLink();
                },
                $this->getLinks()
            )
        );
    }

    public function setLink(string $name, Objects\LinkFactory $link): self
    {
        $this->links[$name] = $link;

        return $this;
    }

    private function getLinks(): array
    {
        return $this->links;
    }
}
