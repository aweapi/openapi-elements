<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

use Waspes\Objects\CallbackRequest;
use Waspes\Objects\CallbackRequests;
use Waspes\Objects\Components;
use Waspes\Objects\Contact;
use Waspes\Objects\Definition;
use Waspes\Objects\Discriminator;
use Waspes\Objects\Encoding;
use Waspes\Objects\Encodings;
use Waspes\Objects\Example;
use Waspes\Objects\Examples;
use Waspes\Objects\Extensions;
use Waspes\Objects\ExternalDocumentation;
use Waspes\Objects\Header;
use Waspes\Objects\Headers;
use Waspes\Objects\Info;
use Waspes\Objects\License;
use Waspes\Objects\Link;
use Waspes\Objects\Links;
use Waspes\Objects\MediaType;
use Waspes\Objects\MediaTypes;
use Waspes\Objects\OAuthFlow;
use Waspes\Objects\OAuthFlows;
use Waspes\Objects\OpenApi;
use Waspes\Objects\Operation;
use Waspes\Objects\OperationResponses;
use Waspes\Objects\Parameter;
use Waspes\Objects\ParameterCollection;
use Waspes\Objects\Parameters;
use Waspes\Objects\Path;
use Waspes\Objects\Paths;
use Waspes\Objects\Reference;
use Waspes\Objects\RequestBodies;
use Waspes\Objects\RequestBody;
use Waspes\Objects\Response;
use Waspes\Objects\Responses;
use Waspes\Objects\Schema;
use Waspes\Objects\SchemaAggregate;
use Waspes\Objects\Schemas;
use Waspes\Objects\SecurityRequirement;
use Waspes\Objects\SecurityRequirementCollection;
use Waspes\Objects\SecurityScheme\ApiKeySecurityScheme;
use Waspes\Objects\SecurityScheme\HttpSecurityScheme;
use Waspes\Objects\SecurityScheme\OAuth2SecurityScheme;
use Waspes\Objects\SecurityScheme\OpenIdConnectSecurityScheme;
use Waspes\Objects\SecuritySchemes;
use Waspes\Objects\Server;
use Waspes\Objects\ServerCollection;
use Waspes\Objects\ServerVariable;
use Waspes\Objects\ServerVariables;
use Waspes\Objects\Tag;
use Waspes\Objects\TagCollection;

trait TestFactory
{
    final protected function createAbstractDefinition(?array $value): Definition
    {
        return new class($value) implements Definition {
            private $value;

            public function __construct(?array $value)
            {
                $this->value = $value;
            }

            public function jsonSerialize(): ?array
            {
                return $this->value;
            }
        };
    }

    final protected function createApiKeySecurityScheme(
        string $name,
        string $in,
        string $description = null,
        Extensions $extensions = null
    ): ApiKeySecurityScheme {
        return new ApiKeySecurityScheme(
            $name,
            $in,
            $description,
            $extensions
        );
    }

    final protected function createCallbackRequest(
        iterable $items,
        Extensions $extensions = null
    ): CallbackRequest {
        return new CallbackRequest(
            $items,
            $extensions
        );
    }

    final protected function createCallbackRequests(iterable $items): CallbackRequests
    {
        return new CallbackRequests($items);
    }

    final protected function createComponents(
        Schemas $schemas = null,
        Responses $responses = null,
        Parameters $parameters = null,
        RequestBodies $requestBodies = null,
        Headers $headers = null,
        SecuritySchemes $securitySchemes = null,
        Links $links = null,
        CallbackRequests $callbacks = null,
        Examples $examples = null,
        Extensions $extensions = null
    ): Components {
        return new Components(
            $schemas,
            $responses,
            $parameters,
            $requestBodies,
            $headers,
            $securitySchemes,
            $links,
            $callbacks,
            $examples,
            $extensions
        );
    }

    final protected function createContact(
        string $name = null,
        string $url = null,
        string $email = null,
        Extensions $extensions = null
    ): Contact {
        return new Contact(
            $name,
            $url,
            $email,
            $extensions
        );
    }

    final protected function createDiscriminator(
        string $propertyName,
        iterable $mapping = []
    ): Discriminator {
        return new Discriminator(
            $propertyName,
            $mapping
        );
    }

    final protected function createEncoding(
        string $contentType = null,
        Headers $headers = null,
        string $style = null,
        bool $explode = true,
        bool $allowReserved = false,
        Extensions $extensions = null
    ): Encoding {
        return new Encoding(
            $contentType,
            $headers,
            $style,
            $explode,
            $allowReserved,
            $extensions
        );
    }

    final protected function createEncodings(iterable $encodings): Encodings
    {
        return new Encodings($encodings);
    }

    /**
     * @param mixed $value
     */
    final protected function createExample(
        string $summary = null,
        string $description = null,
        $value = null,
        string $externalValue = null,
        Extensions $extensions = null
    ): Example {
        return new Example(
            $summary,
            $description,
            $value,
            $externalValue,
            $extensions
        );
    }

    final protected function createExamples(iterable $items): Examples
    {
        return new Examples($items);
    }

    final protected function createExtensions(iterable $items): Extensions
    {
        return new Extensions($items);
    }

    final protected function createExternalDocumentation(
        string $url,
        string $description = null,
        Extensions $extensions = null
    ): ExternalDocumentation {
        return new ExternalDocumentation(
            $url,
            $description,
            $extensions
        );
    }

    final protected function createHeader(
        SchemaAggregate $schema = null,
        MediaTypes $content = null,
        string $description = null,
        bool $required = null,
        bool $deprecated = false,
        bool $allowEmptyValue = false,
        string $style = null,
        bool $explode = null,
        bool $allowReserved = false,
        Examples $examples = null,
        Extensions $extensions = null
    ): Header {
        return new Header(
            $schema,
            $content,
            $description,
            $required,
            $deprecated,
            $allowEmptyValue,
            $style,
            $explode,
            $allowReserved,
            $examples,
            $extensions
        );
    }

    final protected function createHeaders(iterable $headers): Headers
    {
        return new Headers($headers);
    }

    final protected function createHttpSecurityScheme(
        string $scheme,
        string $bearerFormat = null,
        string $description = null,
        Extensions $extensions = null
    ): HttpSecurityScheme {
        return new HttpSecurityScheme(
            $scheme,
            $bearerFormat,
            $description,
            $extensions
        );
    }

    final protected function createInfo(
        string $title,
        string $version,
        string $description = null,
        string $termsOfService = null,
        Contact $contact = null,
        License $license = null,
        Extensions $extensions = null
    ): Info {
        return new Info(
            $title,
            $version,
            $description,
            $termsOfService,
            $contact,
            $license,
            $extensions
        );
    }

    final protected function createLicense(
        string $name,
        string $url = null,
        Extensions $extensions = null
    ): License {
        return new License($name, $url, $extensions);
    }

    /**
     * @param mixed $requestBody
     */
    final protected function createLink(
        string $operationId = null,
        string $operationRef = null,
        string $description = null,
        array $parameters = [],
        $requestBody = null,
        Server $server = null,
        Extensions $extensions = null
    ): Link {
        return new Link(
            $operationId,
            $operationRef,
            $description,
            $parameters,
            $requestBody,
            $server,
            $extensions
        );
    }

    final protected function createLinks(iterable $items): Links
    {
        return new Links($items);
    }

    final protected function createMediaType(
        SchemaAggregate $schema = null,
        Examples $examples = null,
        Encodings $encodings = null,
        Extensions $extensions = null
    ): MediaType {
        return new MediaType(
            $schema,
            $examples,
            $encodings,
            $extensions
        );
    }

    final protected function createMediaTypes(iterable $items): MediaTypes
    {
        return new MediaTypes($items);
    }

    final protected function createOAuth2SecurityScheme(
        OAuthFlows $flows,
        string $description = null,
        Extensions $extensions = null
    ): OAuth2SecurityScheme {
        return new OAuth2SecurityScheme(
            $flows,
            $description,
            $extensions
        );
    }

    final protected function createOAuthFlow(
        iterable $scopes,
        string $authorizationUrl = null,
        string $tokenUrl = null,
        string $refreshUrl = null,
        Extensions $extensions = null
    ): OAuthFlow {
        return new OAuthFlow(
            $scopes,
            $authorizationUrl,
            $tokenUrl,
            $refreshUrl,
            $extensions
        );
    }

    final protected function createOAuthFlows(
        OAuthFlow $implicit = null,
        OAuthFlow $password = null,
        OAuthFlow $clientCredentials = null,
        OAuthFlow $authorizationCode = null,
        Extensions $extensions = null
    ): OAuthFlows {
        return new OAuthFlows(
            $implicit,
            $password,
            $clientCredentials,
            $authorizationCode,
            $extensions
        );
    }

    final protected function createOpenApi(
        string $openapi,
        Info $info,
        Paths $paths,
        ServerCollection $servers = null,
        Components $components = null,
        SecurityRequirementCollection $security = null,
        TagCollection $tags = null,
        ExternalDocumentation $externalDocs = null,
        Extensions $extensions = null
    ): OpenApi {
        return new OpenApi(
            $openapi,
            $info,
            $paths,
            $servers,
            $components,
            $security,
            $tags,
            $externalDocs,
            $extensions
        );
    }

    final protected function createOpenIdConnectSecurityScheme(
        string $openIdConnectUrl,
        string $description = null,
        Extensions $extensions = null
    ): OpenIdConnectSecurityScheme {
        return new OpenIdConnectSecurityScheme(
            $openIdConnectUrl,
            $description,
            $extensions
        );
    }

    final protected function createOperation(
        OperationResponses $responses,
        RequestBody $requestBody = null,
        array $tags = [],
        string $operationId = null,
        string $summary = null,
        string $description = null,
        bool $deprecated = false,
        ParameterCollection $parameters = null,
        SecurityRequirementCollection $security = null,
        CallbackRequests $callbacks = null,
        ServerCollection $servers = null,
        ExternalDocumentation $externalDocs = null,
        Extensions $extensions = null
    ): Operation {
        return new Operation(
            $responses,
            $requestBody,
            $tags,
            $operationId,
            $summary,
            $description,
            $deprecated,
            $parameters,
            $security,
            $callbacks,
            $servers,
            $externalDocs,
            $extensions
        );
    }

    final protected function createOperationResponses(
        iterable $responses,
        Response $default = null,
        Extensions $extensions = null
    ): OperationResponses {
        return new OperationResponses(
            $responses,
            $default,
            $extensions
        );
    }

    final protected function createParameter(
        string $name,
        string $in,
        SchemaAggregate $schema = null,
        MediaTypes $content = null,
        string $description = null,
        bool $required = null,
        bool $deprecated = false,
        bool $allowEmptyValue = false,
        string $style = null,
        bool $explode = null,
        bool $allowReserved = false,
        Examples $examples = null,
        Extensions $extensions = null
    ): Parameter {
        return new Parameter(
            $name,
            $in,
            $schema,
            $content,
            $description,
            $required,
            $deprecated,
            $allowEmptyValue,
            $style,
            $explode,
            $allowReserved,
            $examples,
            $extensions
        );
    }

    final protected function createParameterCollection(iterable $items): ParameterCollection
    {
        return new ParameterCollection($items);
    }

    final protected function createParameters(iterable $parameters): Parameters
    {
        return new Parameters($parameters);
    }

    final protected function createPath(
        string $summary = null,
        Reference $ref = null,
        string $description = null,
        Operation $getOperation = null,
        Operation $putOperation = null,
        Operation $postOperation = null,
        Operation $deleteOperation = null,
        Operation $patchOperation = null,
        Operation $optionsOperation = null,
        Operation $headOperation = null,
        Operation $traceOperation = null,
        ServerCollection $servers = null,
        ParameterCollection $parameters = null,
        Extensions $extensions = null
    ): Path {
        return new Path(
            $summary,
            $ref,
            $description,
            $getOperation,
            $putOperation,
            $postOperation,
            $deleteOperation,
            $patchOperation,
            $optionsOperation,
            $headOperation,
            $traceOperation,
            $servers,
            $parameters,
            $extensions
        );
    }

    final protected function createPaths(
        iterable $paths,
        Extensions $extensions = null
    ): Paths {
        return new Paths($paths, $extensions);
    }

    final protected function createReference(string $href): Reference
    {
        return new Reference($href);
    }

    final protected function createRequestBodies(iterable $requestBodies): RequestBodies
    {
        return new RequestBodies($requestBodies);
    }

    final protected function createRequestBody(
        MediaTypes $content,
        string $description = null,
        bool $required = false,
        Extensions $extensions = null
    ): RequestBody {
        return new RequestBody(
            $content,
            $description,
            $required,
            $extensions
        );
    }

    final protected function createResponse(
        string $description,
        Headers $headers = null,
        MediaTypes $content = null,
        Links $links = null,
        Extensions $extensions = null
    ): Response {
        return new Response(
            $description,
            $headers,
            $content,
            $links,
            $extensions
        );
    }

    final protected function createResponses(iterable $responses): Responses
    {
        return new Responses($responses);
    }

    final protected function createSchema(
        array $attributes,
        Extensions $extensions = null
    ): Schema {
        return new Schema($attributes, $extensions);
    }

    final protected function createSchemas(iterable $schemas): Schemas
    {
        return new Schemas($schemas);
    }

    final protected function createSecurityRequirement(iterable $requirements): SecurityRequirement
    {
        return new SecurityRequirement($requirements);
    }

    final protected function createSecurityRequirementCollection(iterable $requirements): SecurityRequirementCollection
    {
        return new SecurityRequirementCollection($requirements);
    }

    final protected function createSecuritySchemes(iterable $securitySchemes): SecuritySchemes
    {
        return new SecuritySchemes($securitySchemes);
    }

    final protected function createServer(
        string $url,
        string $description = null,
        ServerVariables $variables = null,
        Extensions $extensions = null
    ): Server {
        return new Server(
            $url,
            $description,
            $variables,
            $extensions
        );
    }

    final protected function createServerCollection(iterable $items): ServerCollection
    {
        return new ServerCollection($items);
    }

    final protected function createServerVariable(
        bool $default,
        array $enum = null,
        string $description = null,
        Extensions $extensions = null
    ): ServerVariable {
        return new ServerVariable(
            $default,
            $enum,
            $description,
            $extensions
        );
    }

    final protected function createServerVariables(iterable $variables): ServerVariables
    {
        return new ServerVariables($variables);
    }

    final protected function createTag(
        string $name,
        string $description = null,
        ExternalDocumentation $externalDocs = null,
        Extensions $extensions = null
    ): Tag {
        return new Tag(
            $name,
            $description,
            $externalDocs,
            $extensions
        );
    }

    final protected function createTagCollection(iterable $items): TagCollection
    {
        return new TagCollection($items);
    }
}
