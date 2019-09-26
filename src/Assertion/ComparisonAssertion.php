<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\Value\Assertion\ExaminedValueInterface;
use webignition\BasilModel\Value\ExpectableValueInterface;

class ComparisonAssertion extends ExaminationAssertion implements
    AssertionInterface,
    ComparisonAssertionInterface
{
    private $expectedValue;

    public function __construct(
        string $assertionString,
        ExaminedValueInterface $examinedValue,
        string $comparison,
        ExpectableValueInterface $expectedValue
    ) {
        parent::__construct($assertionString, $examinedValue, $comparison);

        $this->expectedValue = $expectedValue;
    }

    public function getExpectedValue(): ExpectableValueInterface
    {
        return $this->expectedValue;
    }

    public function withExpectedValue(ExpectableValueInterface $value): ComparisonAssertionInterface
    {
        $new = clone $this;
        $new->expectedValue = $value;

        return $new;
    }
}
