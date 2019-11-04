<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class TagCollectionBuilder implements Objects\TagCollectionFactory
{
    private $tags = [];

    public function addTags(Objects\TagFactory ...$tags): self
    {
        foreach ($tags as $tag) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function createTagCollection(): Objects\TagCollection
    {
        return new Objects\TagCollection(
            array_map(
                static function (Objects\TagFactory $factory): Objects\Tag {
                    return $factory->createTag();
                },
                $this->getTags()
            )
        );
    }

    private function getTags(): array
    {
        return $this->tags;
    }
}
