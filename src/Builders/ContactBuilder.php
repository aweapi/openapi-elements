<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects\Contact;
use Aweapi\Openapi\Objects\ContactFactory;

final class ContactBuilder implements ContactFactory
{
    use Properties\OptionalExtensions;

    private $email;

    private $name;

    private $url;

    public function createContact(): Contact
    {
        return new Contact(
            $this->getName(),
            $this->getUrl(),
            $this->getEmail(),
            $this->getExtensions()
        );
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    private function getEmail(): ?string
    {
        return $this->email;
    }

    private function getName(): ?string
    {
        return $this->name;
    }

    private function getUrl(): ?string
    {
        return $this->url;
    }
}
