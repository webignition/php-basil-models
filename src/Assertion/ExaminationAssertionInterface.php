<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\Value\Assertion\ExaminedValueInterface;

interface ExaminationAssertionInterface extends AssertionInterface
{
    public function getExaminedValue(): ExaminedValueInterface;
    public function withExaminedValue(ExaminedValueInterface $value): ExaminationAssertionInterface;
}
