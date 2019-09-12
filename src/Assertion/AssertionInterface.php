<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\Value\AssertionExaminedValueInterface;

interface AssertionInterface
{
    public function getAssertionString(): string;
    public function getExaminedValue(): AssertionExaminedValueInterface;
    public function withExaminedValue(AssertionExaminedValueInterface $value): AssertionInterface;
}
