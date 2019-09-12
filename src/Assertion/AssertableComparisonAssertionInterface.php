<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\Value\Assertion\AssertableExpectedValueInterface;

interface AssertableComparisonAssertionInterface extends AssertableExaminationAssertionInterface
{
    public function getExpectedValue(): AssertableExpectedValueInterface;
}
