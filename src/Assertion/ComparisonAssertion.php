<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\Value\Assertion\AssertionExaminedValueInterface;
use webignition\BasilModel\Value\Assertion\AssertionExpectedValueInterface;

class ComparisonAssertion extends ExaminationAssertion implements
    AssertionInterface,
    ComparisonAssertionInterface
{
    private $expectedValue;

    public function __construct(
        string $assertionString,
        AssertionExaminedValueInterface $examinedValue,
        string $comparison,
        AssertionExpectedValueInterface $expectedValue
    ) {
        parent::__construct($assertionString, $examinedValue, $comparison);

        $this->expectedValue = $expectedValue;
    }

    public function getExpectedValue(): AssertionExpectedValueInterface
    {
        return $this->expectedValue;
    }

    public function withExpectedValue(AssertionExpectedValueInterface $value): ComparisonAssertionInterface
    {
        $new = clone $this;
        $new->expectedValue = $value;

        return $new;
    }
}
