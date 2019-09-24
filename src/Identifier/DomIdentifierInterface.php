<?php

namespace webignition\BasilModel\Identifier;

interface DomIdentifierInterface extends IdentifierInterface
{
    public function getPosition(): ?int;
    public function withPosition(int $position): DomIdentifierInterface;
    public function getParentIdentifier(): ?DomIdentifierInterface;
    public function withParentIdentifier(DomIdentifierInterface $identifier): DomIdentifierInterface;
    public function getElementLocator(): string;
    public function getAttributeName(): ?string;
    public function withAttributeName(string $attributeName): DomIdentifierInterface;
}
