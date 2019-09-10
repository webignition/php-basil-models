<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\Value\AssertionExaminedValueInterface;

abstract class AbstractAssertion implements AssertionInterface
{
    private $assertionString;
    private $examinedValue;

    public function __construct(string $assertionString, AssertionExaminedValueInterface $examinedValue)
    {
        $this->assertionString = $assertionString;
        $this->examinedValue = $examinedValue;
    }

    public function getAssertionString(): string
    {
        return $this->assertionString;
    }

    public function getExaminedValue(): AssertionExaminedValueInterface
    {
        return $this->examinedValue;
    }

    public function withExaminedValue(AssertionExaminedValueInterface $value): AssertionInterface
    {
        $new = clone $this;
        $new->examinedValue = $value;

        return $new;
    }
}
