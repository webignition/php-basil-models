<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\Value\AssertionExaminedValueInterface;

class ExistsAssertion extends AbstractAssertion implements AssertionInterface
{
    public function __construct(string $assertionString, AssertionExaminedValueInterface $examinedValue)
    {
        $comparison = new AssertionComparison(AssertionComparison::EXISTS);

        parent::__construct($assertionString, $examinedValue, $comparison);
    }
}
