<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\Value\ElementValueInterface;
use webignition\BasilModel\Value\ValueInterface;

interface AssertionInterface
{
    public function getAssertionString(): string;
    public function getExaminedValue(): ?ValueInterface;
    public function getComparison(): ?string;
    public function getExpectedValue(): ?ValueInterface;
    public function withExaminedValue(ElementValueInterface $elementValue): AssertionInterface;
    public function withExpectedValue(ElementValueInterface $elementValue): AssertionInterface;
}
