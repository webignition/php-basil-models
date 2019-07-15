<?php

namespace webignition\BasilModel\Identifier;

use webignition\BasilModel\Value\ValueInterface;

interface IdentifierInterface
{
    public function getType(): string;
    public function getValue(): ValueInterface;
    public function getPosition(): int;
    public function getName(): ?string;
    public function getParentIdentifier(): ?IdentifierInterface;
    public function withParentIdentifier(IdentifierInterface $identifier): IdentifierInterface;
    public function withName(string $name): IdentifierInterface;
    public function isActionable(): bool;
    public function __toString(): string;
}
