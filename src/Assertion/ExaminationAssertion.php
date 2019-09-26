<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\Value\ValueInterface;

class ExaminationAssertion extends AbstractAssertion implements ExaminationAssertionInterface
{
    private $examinedValue;

    public function __construct(
        string $assertionString,
        ValueInterface $examinedValue,
        string $comparison
    ) {
        parent::__construct($assertionString, $comparison);

        $this->examinedValue = $examinedValue;
    }

    public function getExaminedValue(): ValueInterface
    {
        return $this->examinedValue;
    }

    public function withExaminedValue(ValueInterface $value): ExaminationAssertionInterface
    {
        $new = clone $this;
        $new->examinedValue = $value;

        return $new;
    }
}
