<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\Value\ValueInterface;

interface AssertionInterface
{
    public function getAssertionString(): string;
    public function getExaminedValue(): ?ValueInterface;
    public function getComparison(): ?string;
    public function getExpectedValue(): ?ValueInterface;
    public function withExaminedValue(ValueInterface $value): AssertionInterface;
    public function withExpectedValue(ValueInterface $value): AssertionInterface;
}
