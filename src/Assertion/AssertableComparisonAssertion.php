<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\Value\Assertion\AssertableExaminedValueInterface;
use webignition\BasilModel\Value\Assertion\AssertableExpectedValueInterface;

class AssertableComparisonAssertion extends AssertableExaminationAssertion implements
    AssertionInterface,
    AssertableComparisonAssertionInterface
{
    private $expectedValue;

    public function __construct(
        string $assertionString,
        AssertableExaminedValueInterface $examinedValue,
        string $comparison,
        AssertableExpectedValueInterface $expectedValue
    ) {
        parent::__construct($assertionString, $examinedValue, $comparison);

        $this->expectedValue = $expectedValue;
    }

    public function getExpectedValue(): AssertableExpectedValueInterface
    {
        return $this->expectedValue;
    }
}
