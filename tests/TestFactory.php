<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

use Waspes\Objects\CallbackRequest;
use Waspes\Objects\CallbackRequestMap;
use Waspes\Objects\ComponentMap;
use Waspes\Objects\Contact;
use Waspes\Objects\Definition;
use Waspes\Objects\Discriminator;
use Waspes\Objects\Encoding;
use Waspes\Objects\EncodingMap;
use Waspes\Objects\Example;
use Waspes\Objects\ExampleMap;
use Waspes\Objects\ExtensionMap;
use Waspes\Objects\ExternalDocumentation;
use Waspes\Objects\Header;
use Waspes\Objects\HeaderMap;
use Waspes\Objects\Info;
use Waspes\Objects\License;
use Waspes\Objects\Link;
use Waspes\Objects\LinkMap;
use Waspes\Objects\MediaType;
use Waspes\Objects\MediaTypeMap;
use Waspes\Objects\OAuthFlow;
use Waspes\Objects\OAuthFlows;
use Waspes\Objects\OpenApi;
use Waspes\Objects\Operation;
use Waspes\Objects\OperationResponseMap;
use Waspes\Objects\Parameter;
use Waspes\Objects\ParameterCollection;
use Waspes\Objects\ParameterMap;
use Waspes\Objects\Path;
use Waspes\Objects\PathMap;
use Waspes\Objects\Reference;
use Waspes\Objects\RequestBody;
use Waspes\Objects\RequestBodyMap;
use Waspes\Objects\Response;
use Waspes\Objects\ResponseMap;
use Waspes\Objects\Schema;
use Waspes\Objects\SchemaAggregate;
use Waspes\Objects\SchemaMap;
use Waspes\Objects\SecurityRequirement;
use Waspes\Objects\SecurityRequirementCollection;
use Waspes\Objects\SecurityScheme\ApiKeySecurityScheme;
use Waspes\Objects\SecurityScheme\HttpSecurityScheme;
use Waspes\Objects\SecurityScheme\OAuth2SecurityScheme;
use Waspes\Objects\SecurityScheme\OpenIdConnectSecurityScheme;
use Waspes\Objects\SecuritySchemeMap;
use Waspes\Objects\Server;
use Waspes\Objects\ServerCollection;
use Waspes\Objects\ServerVariable;
use Waspes\Objects\ServerVariableMap;
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
        ExtensionMap $extensions = null
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
        ExtensionMap $extensions = null
    ): CallbackRequest {
        return new CallbackRequest(
            $items,
            $extensions
        );
    }

    final protected function createCallbackRequestMap(iterable $items): CallbackRequestMap
    {
        return new CallbackRequestMap($items);
    }

    final protected function createComponentMap(
        SchemaMap $schemas = null,
        ResponseMap $responses = null,
        ParameterMap $parameters = null,
        RequestBodyMap $requestBodies = null,
        HeaderMap $headers = null,
        SecuritySchemeMap $securitySchemes = null,
        LinkMap $links = null,
        CallbackRequestMap $callbacks = null,
        ExampleMap $examples = null,
        ExtensionMap $extensions = null
    ): ComponentMap {
        return new ComponentMap(
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
        ExtensionMap $extensions = null
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
        HeaderMap $headers = null,
        string $style = null,
        bool $explode = true,
        bool $allowReserved = false,
        ExtensionMap $extensions = null
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

    final protected function createEncodingMap(iterable $encodings): EncodingMap
    {
        return new EncodingMap($encodings);
    }

    /**
     * @param mixed $value
     */
    final protected function createExample(
        string $summary = null,
        string $description = null,
        $value = null,
        string $externalValue = null,
        ExtensionMap $extensions = null
    ): Example {
        return new Example(
            $summary,
            $description,
            $value,
            $externalValue,
            $extensions
        );
    }

    final protected function createExampleMap(iterable $items): ExampleMap
    {
        return new ExampleMap($items);
    }

    final protected function createExtensionMap(iterable $items): ExtensionMap
    {
        return new ExtensionMap($items);
    }

    final protected function createExternalDocumentation(
        string $url,
        string $description = null,
        ExtensionMap $extensions = null
    ): ExternalDocumentation {
        return new ExternalDocumentation(
            $url,
            $description,
            $extensions
        );
    }

    final protected function createHeader(
        SchemaAggregate $schema = null,
        MediaTypeMap $content = null,
        string $description = null,
        bool $required = null,
        bool $deprecated = false,
        bool $allowEmptyValue = false,
        string $style = null,
        bool $explode = null,
        bool $allowReserved = false,
        ExampleMap $examples = null,
        ExtensionMap $extensions = null
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

    final protected function createHeaderMap(iterable $headers): HeaderMap
    {
        return new HeaderMap($headers);
    }

    final protected function createHttpSecurityScheme(
        string $scheme,
        string $bearerFormat = null,
        string $description = null,
        ExtensionMap $extensions = null
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
        ExtensionMap $extensions = null
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
        ExtensionMap $extensions = null
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
        ExtensionMap $extensions = null
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

    final protected function createLinkMap(iterable $items): LinkMap
    {
        return new LinkMap($items);
    }

    final protected function createMediaType(
        SchemaAggregate $schema = null,
        ExampleMap $examples = null,
        EncodingMap $encodings = null,
        ExtensionMap $extensions = null
    ): MediaType {
        return new MediaType(
            $schema,
            $examples,
            $encodings,
            $extensions
        );
    }

    final protected function createMediaTypeMap(iterable $items): MediaTypeMap
    {
        return new MediaTypeMap($items);
    }

    final protected function createOAuth2SecurityScheme(
        OAuthFlows $flows,
        string $description = null,
        ExtensionMap $extensions = null
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
        ExtensionMap $extensions = null
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
        ExtensionMap $extensions = null
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
        PathMap $paths,
        ServerCollection $servers = null,
        ComponentMap $components = null,
        SecurityRequirementCollection $security = null,
        TagCollection $tags = null,
        ExternalDocumentation $externalDocs = null,
        ExtensionMap $extensions = null
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
        ExtensionMap $extensions = null
    ): OpenIdConnectSecurityScheme {
        return new OpenIdConnectSecurityScheme(
            $openIdConnectUrl,
            $description,
            $extensions
        );
    }

    final protected function createOperation(
        OperationResponseMap $responses,
        RequestBody $requestBody = null,
        array $tags = [],
        string $operationId = null,
        string $summary = null,
        string $description = null,
        bool $deprecated = false,
        ParameterCollection $parameters = null,
        SecurityRequirementCollection $security = null,
        CallbackRequestMap $callbacks = null,
        ServerCollection $servers = null,
        ExternalDocumentation $externalDocs = null,
        ExtensionMap $extensions = null
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

    final protected function createOperationResponseMap(
        iterable $responses,
        Response $default = null,
        ExtensionMap $extensions = null
    ): OperationResponseMap {
        return new OperationResponseMap(
            $responses,
            $default,
            $extensions
        );
    }

    final protected function createParameter(
        string $name,
        string $in,
        SchemaAggregate $schema = null,
        MediaTypeMap $content = null,
        string $description = null,
        bool $required = null,
        bool $deprecated = false,
        bool $allowEmptyValue = false,
        string $style = null,
        bool $explode = null,
        bool $allowReserved = false,
        ExampleMap $examples = null,
        ExtensionMap $extensions = null
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

    final protected function createParameterMap(iterable $parameters): ParameterMap
    {
        return new ParameterMap($parameters);
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
        ExtensionMap $extensions = null
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

    final protected function createPathMap(
        iterable $paths,
        ExtensionMap $extensions = null
    ): PathMap {
        return new PathMap($paths, $extensions);
    }

    final protected function createReference(string $href): Reference
    {
        return new Reference($href);
    }

    final protected function createRequestBody(
        MediaTypeMap $content,
        string $description = null,
        bool $required = false,
        ExtensionMap $extensions = null
    ): RequestBody {
        return new RequestBody(
            $content,
            $description,
            $required,
            $extensions
        );
    }

    final protected function createRequestBodyMap(iterable $requestBodies): RequestBodyMap
    {
        return new RequestBodyMap($requestBodies);
    }

    final protected function createResponse(
        string $description,
        HeaderMap $headers = null,
        MediaTypeMap $content = null,
        LinkMap $links = null,
        ExtensionMap $extensions = null
    ): Response {
        return new Response(
            $description,
            $headers,
            $content,
            $links,
            $extensions
        );
    }

    final protected function createResponseMap(iterable $responses): ResponseMap
    {
        return new ResponseMap($responses);
    }

    final protected function createSchema(
        array $attributes,
        ExtensionMap $extensions = null
    ): Schema {
        return new Schema($attributes, $extensions);
    }

    final protected function createSchemaMap(iterable $schemas): SchemaMap
    {
        return new SchemaMap($schemas);
    }

    final protected function createSecurityRequirement(iterable $requirements): SecurityRequirement
    {
        return new SecurityRequirement($requirements);
    }

    final protected function createSecurityRequirementCollection(iterable $requirements): SecurityRequirementCollection
    {
        return new SecurityRequirementCollection($requirements);
    }

    final protected function createSecuritySchemeMap(iterable $securitySchemes): SecuritySchemeMap
    {
        return new SecuritySchemeMap($securitySchemes);
    }

    final protected function createServer(
        string $url,
        string $description = null,
        ServerVariableMap $variables = null,
        ExtensionMap $extensions = null
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
        ExtensionMap $extensions = null
    ): ServerVariable {
        return new ServerVariable(
            $default,
            $enum,
            $description,
            $extensions
        );
    }

    final protected function createServerVariableMap(iterable $variables): ServerVariableMap
    {
        return new ServerVariableMap($variables);
    }

    final protected function createTag(
        string $name,
        string $description = null,
        ExternalDocumentation $externalDocs = null,
        ExtensionMap $extensions = null
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
