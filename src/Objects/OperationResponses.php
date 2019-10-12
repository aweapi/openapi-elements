<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

use Aweapi\Openapi\Extensions;
use Aweapi\Openapi\ValueObject;

final class OperationResponses extends ValueObject
{
    use Properties\OptionalExtensions;

    private $default;

    private $responses = [];

    public function __construct(
        iterable $responses,
        Response $default = null,
        Extensions $extensions = null
    ) {
        $this->default = $default;

        foreach ($responses as $httpStatus => $response) {
            // Force cast to string, because of PHP juggling,
            // which converts HTTP status numbers into int.
            $this->setResponse((string) $httpStatus, $response);
        }

        $this->extensions = $extensions;
    }

    public function getDefault(): Response
    {
        return $this->default;
    }

    /**
     * @return Response[]
     */
    public function getResponses(): array
    {
        return $this->responses;
    }

    public function hasDefault(): bool
    {
        return isset($this->default);
    }

    public function jsonSerialize(): ?array
    {
        return $this->extendedProperties(parent::jsonSerialize());
    }

    protected function normalizeOptionalProperties(): array
    {
        $responses = [];

        foreach ($this->getResponses() as $httpStatus => $response) {
            $responses[(string) $httpStatus] = $response->jsonSerialize();
        }

        if ($this->hasDefault()) {
            $responses['default'] = $this->getDefault()->jsonSerialize();
        }

        return $responses;
    }

    private function setResponse(string $httpStatus, Response $response): void
    {
        $this->responses[$httpStatus] = $response;
    }
}
