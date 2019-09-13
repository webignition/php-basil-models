<?php

namespace webignition\BasilModel\Identifier;

class WrappedIdentifier implements WrappedIdentifierInterface
{
    private $wrappedIdentifier;

    public function __construct(IdentifierInterface $identifier)
    {
        $this->wrappedIdentifier = $identifier;
    }

    public function getWrappedIdentifier(): IdentifierInterface
    {
        return $this->wrappedIdentifier;
    }

    public function getName(): ?string
    {
        return $this->wrappedIdentifier->getName();
    }

    public function withName(string $name): IdentifierInterface
    {
        return $this->wrappedIdentifier->withName($name);
    }

    public function __toString(): string
    {
        return $this->wrappedIdentifier->__toString();
    }
}
