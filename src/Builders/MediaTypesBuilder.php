<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class MediaTypesBuilder implements Objects\MediaTypesFactory
{
    private $mediaTypes = [];

    public function addMediaTypes(iterable $mediaTypes): self
    {
        foreach ($mediaTypes as $key => $mediaType) {
            $this->setMediaType($key, $mediaType);
        }

        return $this;
    }

    public function createMediaTypes(): Objects\MediaTypes
    {
        return new Objects\MediaTypes(
            array_map(
                static function (Objects\MediaTypeFactory $factory): Objects\MediaType {
                    return $factory->createMediaType();
                },
                $this->getMediaTypes()
            )
        );
    }

    public function setMediaType(string $key, Objects\MediaTypeFactory $mediaType): self
    {
        $this->mediaTypes[$key] = $mediaType;

        return $this;
    }

    private function getMediaTypes(): array
    {
        return $this->mediaTypes;
    }
}
