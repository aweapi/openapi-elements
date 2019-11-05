<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class HeadersBuilder implements Objects\HeadersFactory
{
    private $headers = [];

    public function addHeaders(iterable $headers): self
    {
        foreach ($headers as $key => $header) {
            $this->setHeader($key, $header);
        }

        return $this;
    }

    public function createHeaders(): Objects\Headers
    {
        return new Objects\Headers(
            array_map(
                static function (Objects\HeaderAggregateFactory $factory): Objects\HeaderAggregate {
                    return $factory->createHeaderAggregate();
                },
                $this->getHeaders()
            )
        );
    }

    public function setHeader(string $key, Objects\HeaderAggregateFactory $header): self
    {
        $this->headers[$key] = $header;

        return $this;
    }

    private function getHeaders(): array
    {
        return $this->headers;
    }
}
