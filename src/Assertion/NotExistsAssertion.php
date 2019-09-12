<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\Value\AssertionExaminedValueInterface;

class NotExistsAssertion extends AbstractAssertion implements AssertionInterface
{
    public function __construct(string $assertionString, AssertionExaminedValueInterface $examinedValue)
    {
        $comparison = new AssertionComparison(AssertionComparison::NOT_EXISTS);

        parent::__construct($assertionString, $examinedValue, $comparison);
    }
}
