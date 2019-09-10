<?php

namespace webignition\BasilModel\Assertion;

class ExistsAssertion extends AbstractAssertion implements AssertionInterface
{
    public function getComparison(): string
    {
        return AssertionComparisons::EXISTS;
    }
}
