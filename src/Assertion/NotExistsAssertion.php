<?php

namespace webignition\BasilModel\Assertion;

class NotExistsAssertion extends AbstractAssertion implements AssertionInterface
{
    public function getComparison(): string
    {
        return AssertionComparisons::NOT_EXISTS;
    }
}
