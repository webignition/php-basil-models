<?php

namespace webignition\BasilModel\Assertion;

class MatchesAssertion extends AbstractValueComparisonAssertion implements
    AssertionInterface,
    ValueComparisonAssertionInterface
{
    public function getComparison(): string
    {
        return AssertionComparisons::MATCHES;
    }
}
