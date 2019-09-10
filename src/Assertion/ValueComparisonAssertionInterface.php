<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\Value\AssertionExpectedValueInterface;

interface ValueComparisonAssertionInterface extends AssertionInterface
{
    public function getExpectedValue(): AssertionExpectedValueInterface;
    public function withExpectedValue(AssertionExpectedValueInterface $value): ValueComparisonAssertionInterface;
}
