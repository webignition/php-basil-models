<?php

namespace webignition\BasilModel\Identifier;

interface ElementIdentifierInterface extends IdentifierInterface
{
    public function getValue(): string;
    public function getPosition(): int;
    public function getName(): ?string;
    public function getParentIdentifier(): ?ElementIdentifierInterface;
    public function withParentIdentifier(ElementIdentifierInterface $identifier): ElementIdentifierInterface;
}
