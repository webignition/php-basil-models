<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\Identifier\IdentifierInterface;
use webignition\BasilModel\Value\ValueInterface;

interface AssertionInterface
{
    public function getAssertionString(): string;
    public function getIdentifier(): ?IdentifierInterface;
    public function getComparison(): ?string;
    public function getValue(): ?ValueInterface;
}
