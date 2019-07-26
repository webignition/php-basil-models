<?php

namespace webignition\BasilModel\Identifier;

interface ElementIdentifierInterface extends IdentifierInterface
{
    public function getPosition(): int;
    public function getParentIdentifier(): ?ElementIdentifierInterface;
    public function withParentIdentifier(ElementIdentifierInterface $identifier): ElementIdentifierInterface;
    public function getAttributeName(): ?string;
    public function withAttributeName(string $attributeName): ElementIdentifierInterface;
}
