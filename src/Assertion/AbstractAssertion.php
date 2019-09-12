<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\Value\AssertionExaminedValueInterface;

abstract class AbstractAssertion implements AssertionInterface
{
    private $assertionString;
    private $examinedValue;
    private $comparison;

    public function __construct(
        string $assertionString,
        AssertionExaminedValueInterface $examinedValue,
        AssertionComparisonInterface $comparison
    ) {
        $this->assertionString = $assertionString;
        $this->examinedValue = $examinedValue;
        $this->comparison = $comparison;
    }

    public function getAssertionString(): string
    {
        return $this->assertionString;
    }

    public function getExaminedValue(): AssertionExaminedValueInterface
    {
        return $this->examinedValue;
    }

    public function withExaminedValue(AssertionExaminedValueInterface $value): AssertionInterface
    {
        $new = clone $this;
        $new->examinedValue = $value;

        return $new;
    }

    public function getComparison(): AssertionComparison
    {
        return $this->comparison;
    }
}
