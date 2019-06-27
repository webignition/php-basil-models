<?php

namespace webignition\BasilModel\Identifier;

interface IdentifierInterface
{
    public function getType(): string;
    public function getValue(): string;
    public function getPosition(): int;
    public function getName(): ?string;
    public function getParentIdentifier(): ?IdentifierInterface;
    public function withParentIdentifier(IdentifierInterface $identifier): IdentifierInterface;
    public function __toString(): string;
}
