<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\Value\ExpectableValueInterface;

interface ComparisonAssertionInterface extends ExaminationAssertionInterface
{
    public function getExpectedValue(): ExpectableValueInterface;
    public function withExpectedValue(ExpectableValueInterface $value): ComparisonAssertionInterface;
}
