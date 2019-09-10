<?php

namespace webignition\BasilModel\Assertion;

class IncludesAssertion extends AbstractValueComparisonAssertion implements
    AssertionInterface,
    ValueComparisonAssertionInterface
{
    public function getComparison(): string
    {
        return AssertionComparisons::INCLUDES;
    }
}
