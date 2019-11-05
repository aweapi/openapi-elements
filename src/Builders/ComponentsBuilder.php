<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class ComponentsBuilder implements Objects\ComponentsFactory
{
    use Properties\OptionalExtensions;

    private $callbacks;

    private $examples;

    private $headers;

    private $links;

    private $parameters;

    private $requestBodies;

    private $responses;

    private $schemas;

    private $securitySchemes;

    public function createComponents(): Objects\Components
    {
        return new Objects\Components(
            $this->getSchemas() ? $this->getSchemas()->createSchemas() : null,
            $this->getResponses() ? $this->getResponses()->createResponses() : null,
            $this->getParameters() ? $this->getParameters()->createParameters() : null,
            $this->getRequestBodies() ? $this->getRequestBodies()->createRequestBodies() : null,
            $this->getHeaders() ? $this->getHeaders()->createHeaders() : null,
            null,
            $this->getLinks() ? $this->getLinks()->createLinks() : null,
            $this->getCallbacks() ? $this->getCallbacks()->createCallbackRequests() : null,
            $this->getExample() ? $this->getExample()->createExamples() : null,
            $this->getExtensions()
        );
    }

    public function setCallbacks(Objects\CallbackRequestsFactory $callbacks): self
    {
        $this->callbacks = $callbacks;

        return $this;
    }

    public function setExamples(Objects\ExamplesFactory $examples): self
    {
        $this->examples = $examples;

        return $this;
    }

    public function setHeaders(Objects\HeadersFactory $headers): self
    {
        $this->headers = $headers;

        return $this;
    }

    public function setLinks(Objects\LinksFactory $links): self
    {
        $this->links = $links;

        return $this;
    }

    public function setParameters(Objects\ParametersFactory $parameters): self
    {
        $this->parameters = $parameters;

        return $this;
    }

    public function setRequestBodies(Objects\RequestBodiesFactory $requestBodies): self
    {
        $this->requestBodies = $requestBodies;

        return $this;
    }

    public function setResponses(Objects\ResponsesFactory $responses): self
    {
        $this->responses = $responses;

        return $this;
    }

    public function setSchemas(Objects\SchemasFactory $schemas): self
    {
        $this->schemas = $schemas;

        return $this;
    }

    private function getCallbacks(): ?Objects\CallbackRequestsFactory
    {
        return $this->callbacks;
    }

    private function getExample(): ?Objects\ExamplesFactory
    {
        return $this->examples;
    }

    private function getHeaders(): ?Objects\HeadersFactory
    {
        return $this->headers;
    }

    private function getLinks(): ?Objects\LinksFactory
    {
        return $this->links;
    }

    private function getParameters(): ?Objects\ParametersFactory
    {
        return $this->parameters;
    }

    private function getRequestBodies(): ?Objects\RequestBodiesFactory
    {
        return $this->requestBodies;
    }

    private function getResponses(): ?Objects\ResponsesFactory
    {
        return $this->responses;
    }

    private function getSchemas(): ?Objects\SchemasFactory
    {
        return $this->schemas;
    }
}
