<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\Identifier\IdentifierInterface;
use webignition\BasilModel\IdentifierContainerInterface;
use webignition\BasilModel\IdentifierContainerTrait;
use webignition\BasilModel\Value\ValueInterface;
use webignition\BasilModel\ValueContainerInterface;
use webignition\BasilModel\ValueContainerTrait;

class Assertion implements AssertionInterface, IdentifierContainerInterface, ValueContainerInterface
{
    use IdentifierContainerTrait;
    use ValueContainerTrait;

    private $assertionString;
    private $comparison;

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
}
