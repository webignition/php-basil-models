<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\Value\AssertionExpectedValueInterface;

interface ComparisonAssertionInterface extends ExaminationAssertionInterface
{
    public function getExpectedValue(): AssertionExpectedValueInterface;
    public function withExpectedValue(AssertionExpectedValueInterface $value): ComparisonAssertionInterface;
}