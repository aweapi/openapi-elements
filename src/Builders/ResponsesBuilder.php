<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class ResponsesBuilder implements Objects\ResponsesFactory
{
    private $responses = [];

    public function addResponses(iterable $responses): self
    {
        foreach ($responses as $name => $response) {
            $this->setResponse($name, $response);
        }

        return $this;
    }

    public function createResponses(): Objects\Responses
    {
        return new Objects\Responses(
            array_map(
                static function (Objects\ResponseAggregateFactory $factory): Objects\ResponseAggregate {
                    return $factory->createResponseAggregate();
                },
                $this->getResponses()
            )
        );
    }

    public function setResponse(string $name, Objects\ResponseAggregateFactory $response): self
    {
        $this->responses[$name] = $response;

        return $this;
    }

    private function getResponses(): array
    {
        return $this->responses;
    }
}
