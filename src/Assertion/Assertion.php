<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\Identifier\IdentifierInterface;
use webignition\BasilModel\IdentifierContainerInterface;
use webignition\BasilModel\IdentifierContainerTrait;
use webignition\BasilModel\Value\ValueInterface;

class Assertion implements AssertionInterface, IdentifierContainerInterface
{
    use IdentifierContainerTrait;

    private $assertionString;
    private $comparison;
    private $value;

    public function __construct(
        string $assertionString,
        ?IdentifierInterface $identifier,
        ?string $comparison,
        ?ValueInterface $value = null
    ) {
        $this->assertionString = $assertionString;
        $this->identifier = $identifier;
        $this->comparison = $comparison;
        $this->value = $value;
    }

    public function getAssertionString(): string
    {
        return $this->assertionString;
    }

    public function getComparison(): ?string
    {
        return $this->comparison;
    }

    public function getValue(): ?ValueInterface
    {
        return $this->value;
    }
}
