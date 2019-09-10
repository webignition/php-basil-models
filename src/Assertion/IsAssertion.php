<?php

namespace webignition\BasilModel\Assertion;

class IsAssertion extends AbstractValueComparisonAssertion implements
    AssertionInterface,
    ValueComparisonAssertionInterface
{
    public function getComparison(): string
    {
        return AssertionComparisons::IS;
    }
}
