<?php

namespace webignition\BasilModel\Assertion;

class IsNotAssertion extends AbstractValueComparisonAssertion implements
    AssertionInterface,
    ValueComparisonAssertionInterface
{
    public function getComparison(): string
    {
        return AssertionComparisons::IS_NOT;
    }
}
