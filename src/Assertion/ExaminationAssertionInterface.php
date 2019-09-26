<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\Value\ValueInterface;

interface ExaminationAssertionInterface extends AssertionInterface
{
    public function getExaminedValue(): ValueInterface;
    public function withExaminedValue(ValueInterface $value): ExaminationAssertionInterface;
}
