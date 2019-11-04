<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class EncodingsBuilder implements Objects\EncodingsFactory
{
    private $encodings = [];

    public function addEncodings(iterable $encodings): self
    {
        foreach ($encodings as $key => $encoding) {
            $this->setEncoding($key, $encoding);
        }

        return $this;
    }

    public function createEncodings(): Objects\Encodings
    {
        return new Objects\Encodings(
            array_map(
                static function (Objects\EncodingFactory $factory): Objects\Encoding {
                    return $factory->createEncoding();
                },
                $this->getEncodings()
            )
        );
    }

    public function setEncoding(string $key, Objects\EncodingFactory $encoding): self
    {
        $this->encodings[$key] = $encoding;

        return $this;
    }

    private function getEncodings(): array
    {
        return $this->encodings;
    }
}
