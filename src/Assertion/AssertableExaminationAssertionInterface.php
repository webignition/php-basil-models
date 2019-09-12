<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\Value\Assertion\AssertableExaminedValueInterface;

interface AssertableExaminationAssertionInterface extends AssertionInterface
{
    public function getExaminedValue(): AssertableExaminedValueInterface;
}
