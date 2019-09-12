<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\Value\Assertion\ExaminedValueInterface;

class ExaminationAssertion extends AbstractAssertion implements ExaminationAssertionInterface
{
    private $examinedValue;

    public function __construct(
        string $assertionString,
        ExaminedValueInterface $examinedValue,
        string $comparison
    ) {
        parent::__construct($assertionString, $comparison);

        $this->examinedValue = $examinedValue;
    }

    public function getExaminedValue(): ExaminedValueInterface
    {
        return $this->examinedValue;
    }

    public function withExaminedValue(ExaminedValueInterface $value): ExaminationAssertionInterface
    {
        $new = clone $this;
        $new->examinedValue = $value;

        return $new;
    }
}
