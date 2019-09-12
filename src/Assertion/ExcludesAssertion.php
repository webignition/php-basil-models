<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\Value\AssertionExaminedValueInterface;
use webignition\BasilModel\Value\AssertionExpectedValueInterface;

class ExcludesAssertion extends AbstractValueComparisonAssertion implements
    AssertionInterface,
    ValueComparisonAssertionInterface
{
    public function __construct(
        string $assertionString,
        AssertionExaminedValueInterface $examinedValue,
        AssertionExpectedValueInterface $expectedValue
    ) {
        $comparison = new AssertionComparison(AssertionComparison::EXCLUDES);

        parent::__construct($assertionString, $examinedValue, $comparison, $expectedValue);
    }
}
