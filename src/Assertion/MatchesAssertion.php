<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\Value\AssertionExaminedValueInterface;
use webignition\BasilModel\Value\AssertionExpectedValueInterface;

class MatchesAssertion extends AbstractValueComparisonAssertion implements
    AssertionInterface,
    ValueComparisonAssertionInterface
{
    public function __construct(
        string $assertionString,
        AssertionExaminedValueInterface $examinedValue,
        AssertionExpectedValueInterface $expectedValue
    ) {
        $comparison = new AssertionComparison(AssertionComparison::MATCHES);

        parent::__construct($assertionString, $examinedValue, $comparison, $expectedValue);
    }
}
