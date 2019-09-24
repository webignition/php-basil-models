<?php

namespace webignition\BasilModel\Identifier;

interface DomIdentifierInterface extends IdentifierInterface
{
    public function getOrdinalPosition(): ?int;
    public function withOrdinalPosition(int $ordinalPosition): DomIdentifierInterface;
    public function getParentIdentifier(): ?DomIdentifierInterface;
    public function withParentIdentifier(DomIdentifierInterface $identifier): DomIdentifierInterface;
    public function getLocator(): string;
    public function getAttributeName(): ?string;
    public function withAttributeName(string $attributeName): DomIdentifierInterface;
}
