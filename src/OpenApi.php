<?php

declare(strict_types=1);

namespace Waspes\Objects;

final class OpenApi extends ValueObject
{
    use Properties\OptionalExternalDocs;
    use Properties\OptionalExtensions;
    use Properties\OptionalSecurityRequirements;
    use Properties\Servers;

    public const LATEST_VERSION = '3.0.2';

    private $components;

    private $info;

    private $openapi;

    private $paths;

    private $tags;

    public function __construct(
        string $openapi,
        Info $info,
        Paths $paths,
        ServerCollection $servers = null,
        Components $components = null,
        SecurityRequirementCollection $security = null,
        TagCollection $tags = null,
        ExternalDocumentation $externalDocs = null,
        Extensions $extensions = null
    ) {
        if (!$servers || !$servers->hasItems()) {
            // If the servers property is not provided, or is an empty array,
            // the default value would be a Server Object with a url value of `/`.
            $servers = new ServerCollection([new Server('/')]);
        }

        $this->openapi = $openapi;
        $this->info = $info;
        $this->paths = $paths;
        $this->servers = $servers;
        $this->components = $components;
        $this->security = $security;
        $this->tags = $tags;
        $this->externalDocs = $externalDocs;
        $this->extensions = $extensions;
    }

    public function getComponents(): Components
    {
        return $this->components;
    }

    public function getInfo(): Info
    {
        return $this->info;
    }

    public function getOpenapi(): string
    {
        return $this->openapi;
    }

    public function getPaths(): Paths
    {
        return $this->paths;
    }

    public function getTags(): TagCollection
    {
        return $this->tags;
    }

    public function hasComponents(): bool
    {
        return isset($this->components);
    }

    public function hasTags(): bool
    {
        return isset($this->tags);
    }

    public function jsonSerialize(): ?array
    {
        return $this->extendedProperties(parent::jsonSerialize());
    }

    protected function normalizeOptionalProperties(): array
    {
        return [
            'servers' => $this->getNormalizedServers(),
            'components' => $this->hasComponents() ? $this->getComponents()->jsonSerialize() : null,
            'security' => $this->getNormalizedSecurity(),
            'tags' => $this->hasTags() ? $this->getTags()->jsonSerialize() : null,
            'externalDocs' => $this->getNormalizedExternalDocs(),
        ];
    }

    protected function normalizeRequiredProperties(): array
    {
        return [
            'openapi' => $this->getOpenapi(),
            'info' => $this->getInfo()->jsonSerialize() ?: self::emptyObject(),
            'paths' => $this->getPaths()->jsonSerialize() ?: self::emptyObject(),
        ];
    }
}
