<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\Value\Assertion\ExaminedValueInterface;
use webignition\BasilModel\Value\Assertion\ExpectedValueInterface;

class ComparisonAssertion extends ExaminationAssertion implements
    AssertionInterface,
    ComparisonAssertionInterface
{
    private $expectedValue;

    public function __construct(
        string $assertionString,
        ExaminedValueInterface $examinedValue,
        string $comparison,
        ExpectedValueInterface $expectedValue
    ) {
        parent::__construct($assertionString, $examinedValue, $comparison);

        $this->expectedValue = $expectedValue;
    }

    public function getExpectedValue(): ExpectedValueInterface
    {
        return $this->expectedValue;
    }

    public function withExpectedValue(ExpectedValueInterface $value): ComparisonAssertionInterface
    {
        $new = clone $this;
        $new->expectedValue = $value;

        return $new;
    }
}
