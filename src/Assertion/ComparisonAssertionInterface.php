<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\Value\Assertion\ExpectedValueInterface;

interface ComparisonAssertionInterface extends ExaminationAssertionInterface
{
    public function getExpectedValue(): ExpectedValueInterface;
    public function withExpectedValue(ExpectedValueInterface $value): ComparisonAssertionInterface;
}
