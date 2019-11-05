<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class OperationResponsesBuilder implements Objects\OperationResponsesFactory
{
    use Properties\OptionalExtensions;

    private $default;

    private $responses = [];

    public function addResponses(iterable $responses): self
    {
        foreach ($responses as $httpStatus => $response) {
            // Force cast to string, because of PHP juggling,
            // which converts HTTP status numbers into int.
            $this->setResponse((string) $httpStatus, $response);
        }

        return $this;
    }

    public function createOperationResponses(): Objects\OperationResponses
    {
        return new Objects\OperationResponses(
            array_map(
                static function (Objects\ResponseFactory $factory): Objects\Response {
                    return $factory->createResponse();
                },
                $this->getResponses()
            ),
            $this->getDefault() ? $this->getDefault()->createResponse() : null,
            $this->getExtensions()
        );
    }

    public function setDefault(Objects\ResponseFactory $response): self
    {
        $this->default = $response;

        return $this;
    }

    public function setResponse(string $httpStatus, Objects\ResponseFactory $response): self
    {
        $this->responses[$httpStatus] = $response;

        return $this;
    }

    private function getDefault(): ?Objects\ResponseFactory
    {
        return $this->default;
    }

    private function getResponses(): array
    {
        return $this->responses;
    }
}
