<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\Value\AssertionExaminedValueInterface;

interface ExaminationAssertionInterface extends AssertionInterface
{
    public function getExaminedValue(): AssertionExaminedValueInterface;
    public function withExaminedValue(AssertionExaminedValueInterface $value): ExaminationAssertionInterface;
}
