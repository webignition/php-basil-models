<?php

namespace webignition\BasilModel\Identifier;

use webignition\BasilModel\Value\ValueInterface;

interface IdentifierInterface
{
    public function getType(): string;
    public function getValue(): ValueInterface;
    public function getName(): ?string;
    public function withName(string $name): IdentifierInterface;
    public function __toString(): string;
}
