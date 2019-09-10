<?php

namespace webignition\BasilModel\Assertion;

class ExcludesAssertion extends AbstractValueComparisonAssertion implements
    AssertionInterface,
    ValueComparisonAssertionInterface
{
    public function getComparison(): string
    {
        return AssertionComparisons::EXCLUDES;
    }
}
