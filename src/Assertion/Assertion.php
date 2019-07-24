<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\Value\ElementValueInterface;
use webignition\BasilModel\Value\ValueInterface;

class Assertion implements AssertionInterface
{
    private $assertionString;
    private $examinedValue;
    private $comparison;
    private $expectedValue;

    public function __construct(
        string $assertionString,
        ?ValueInterface $examinedValue,
        ?string $comparison,
        ?ValueInterface $expectedValue = null
    ) {
        $this->assertionString = $assertionString;
        $this->examinedValue = $examinedValue;
        $this->comparison = $comparison;
        $this->expectedValue = $expectedValue;
    }

    public function getAssertionString(): string
    {
        return $this->assertionString;
    }

    public function getExaminedValue(): ?ValueInterface
    {
        return $this->examinedValue;
    }

    public function getComparison(): ?string
    {
        return $this->comparison;
    }

    public function getExpectedValue(): ?ValueInterface
    {
        return $this->expectedValue;
    }

    public function withExaminedValue(ElementValueInterface $elementValue): AssertionInterface
    {
        $new = clone $this;
        $new->examinedValue = $elementValue;

        return $new;
    }
}
