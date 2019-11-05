<?php

declare(strict_types=1);

namespace Aweapi\Openapi;

final class BuilderFactory
{
    public function callbackRequest(): Builders\CallbackRequestBuilder
    {
        return new Builders\CallbackRequestBuilder();
    }

    public function callbackRequests(): Builders\CallbackRequestsBuilder
    {
        return new Builders\CallbackRequestsBuilder();
    }

    public function components(): Builders\ComponentsBuilder
    {
        return new Builders\ComponentsBuilder();
    }

    public function contact(): Builders\ContactBuilder
    {
        return new Builders\ContactBuilder();
    }

    public function discriminator(): Builders\DiscriminatorBuilder
    {
        return new Builders\DiscriminatorBuilder();
    }

    public function encoding(): Builders\EncodingBuilder
    {
        return new Builders\EncodingBuilder();
    }

    public function encodings(): Builders\EncodingsBuilder
    {
        return new Builders\EncodingsBuilder();
    }

    public function example(): Builders\ExampleBuilder
    {
        return new Builders\ExampleBuilder();
    }

    public function examples(): Builders\ExamplesBuilder
    {
        return new Builders\ExamplesBuilder();
    }

    public function externalDocs(): Builders\ExternalDocumentationBuilder
    {
        return new Builders\ExternalDocumentationBuilder();
    }

    public function header(): Builders\HeaderBuilder
    {
        return new Builders\HeaderBuilder();
    }

    public function headers(): Builders\HeadersBuilder
    {
        return new Builders\HeadersBuilder();
    }

    public function info(): Builders\InfoBuilder
    {
        return new Builders\InfoBuilder();
    }

    public function license(): Builders\LicenseBuilder
    {
        return new Builders\LicenseBuilder();
    }

    public function link(): Builders\LinkBuilder
    {
        return new Builders\LinkBuilder();
    }

    public function links(): Builders\LinksBuilder
    {
        return new Builders\LinksBuilder();
    }

    public function mediaType(): Builders\MediaTypeBuilder
    {
        return new Builders\MediaTypeBuilder();
    }

    public function mediaTypes(): Builders\MediaTypesBuilder
    {
        return new Builders\MediaTypesBuilder();
    }

    public function openapi(): Builders\OpenApiBuilder
    {
        return new Builders\OpenApiBuilder();
    }

    public function operation(): Builders\OperationBuilder
    {
        return new Builders\OperationBuilder();
    }

    public function operationResponses(): Builders\OperationResponsesBuilder
    {
        return new Builders\OperationResponsesBuilder();
    }

    public function parameter(): Builders\ParameterBuilder
    {
        return new Builders\ParameterBuilder();
    }

    public function parameterCollection(): Builders\ParameterCollectionBuilder
    {
        return new Builders\ParameterCollectionBuilder();
    }

    public function parameters(): Builders\ParametersBuilder
    {
        return new Builders\ParametersBuilder();
    }

    public function path(): Builders\PathBuilder
    {
        return new Builders\PathBuilder();
    }

    public function paths(): Builders\PathsBuilder
    {
        return new Builders\PathsBuilder();
    }

    public function ref(): Builders\ReferenceBuilder
    {
        return new Builders\ReferenceBuilder();
    }

    public function requestBodies(): Builders\RequestBodiesBuilder
    {
        return new Builders\RequestBodiesBuilder();
    }

    public function requestBody(): Builders\RequestBodyBuilder
    {
        return new Builders\RequestBodyBuilder();
    }

    public function response(): Builders\ResponseBuilder
    {
        return new Builders\ResponseBuilder();
    }

    public function responses(): Builders\ResponsesBuilder
    {
        return new Builders\ResponsesBuilder();
    }

    public function schema(): Builders\SchemaBuilder
    {
        return new Builders\SchemaBuilder();
    }

    public function schemas(): Builders\SchemasBuilder
    {
        return new Builders\SchemasBuilder();
    }

    public function securityRequirement(): Builders\SecurityRequirementBuilder
    {
        return new Builders\SecurityRequirementBuilder();
    }

    public function securityRequirementCollection(): Builders\SecurityRequirementCollectionBuilder
    {
        return new Builders\SecurityRequirementCollectionBuilder();
    }

    public function server(): Builders\ServerBuilder
    {
        return new Builders\ServerBuilder();
    }

    public function serverCollection(): Builders\ServerCollectionBuilder
    {
        return new Builders\ServerCollectionBuilder();
    }

    public function serverVariable(): Builders\ServerVariableBuilder
    {
        return new Builders\ServerVariableBuilder();
    }

    public function serverVariables(): Builders\ServerVariablesBuilder
    {
        return new Builders\ServerVariablesBuilder();
    }

    public function tag(): Builders\TagBuilder
    {
        return new Builders\TagBuilder();
    }

    public function tagCollection(): Builders\TagCollectionBuilder
    {
        return new Builders\TagCollectionBuilder();
    }
}
