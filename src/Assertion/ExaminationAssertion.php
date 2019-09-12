<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\Value\AssertionExaminedValueInterface;

class ExaminationAssertion extends AbstractAssertion implements ExaminationAssertionInterface
{
    private $examinedValue;

    public function __construct(
        string $assertionString,
        AssertionExaminedValueInterface $examinedValue,
        string $comparison
    ) {
        parent::__construct($assertionString, $comparison);

        $this->examinedValue = $examinedValue;
    }

    public function getExaminedValue(): AssertionExaminedValueInterface
    {
        return $this->examinedValue;
    }

    public function withExaminedValue(AssertionExaminedValueInterface $value): ExaminationAssertionInterface
    {
        $new = clone $this;
        $new->examinedValue = $value;

        return $new;
    }
}
