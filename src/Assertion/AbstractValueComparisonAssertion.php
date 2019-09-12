<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\Value\AssertionExaminedValueInterface;
use webignition\BasilModel\Value\AssertionExpectedValueInterface;

abstract class AbstractValueComparisonAssertion extends AbstractAssertion implements
    AssertionInterface,
    ValueComparisonAssertionInterface
{
    private $expectedValue;

    public function __construct(
        string $assertionString,
        AssertionExaminedValueInterface $examinedValue,
        AssertionExpectedValueInterface $expectedValue
    ) {
        parent::__construct($assertionString, $examinedValue);

        $this->expectedValue = $expectedValue;
    }

    public function getExpectedValue(): AssertionExpectedValueInterface
    {
        return $this->expectedValue;
    }

    public function withExpectedValue(AssertionExpectedValueInterface $value): ValueComparisonAssertionInterface
    {
        $new = clone $this;
        $new->expectedValue = $value;

        return $new;
    }
}
