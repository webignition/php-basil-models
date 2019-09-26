<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\Value\ValueInterface;

class ComparisonAssertion extends ExaminationAssertion implements
    AssertionInterface,
    ComparisonAssertionInterface
{
    private $expectedValue;

    public function __construct(
        string $assertionString,
        ValueInterface $examinedValue,
        string $comparison,
        ValueInterface $expectedValue
    ) {
        parent::__construct($assertionString, $examinedValue, $comparison);

        $this->expectedValue = $expectedValue;
    }

    public function getExpectedValue(): ValueInterface
    {
        return $this->expectedValue;
    }

    public function withExpectedValue(ValueInterface $value): ComparisonAssertionInterface
    {
        $new = clone $this;
        $new->expectedValue = $value;

        return $new;
    }
}
