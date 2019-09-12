<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\Value\Assertion\AssertableExaminedValueInterface;

class AssertableExaminationAssertion extends AbstractAssertion implements AssertableExaminationAssertionInterface
{
    private $examinedValue;

    public function __construct(
        string $assertionString,
        AssertableExaminedValueInterface $examinedValue,
        string $comparison
    ) {
        parent::__construct($assertionString, $comparison);

        $this->examinedValue = $examinedValue;
    }

    public function getExaminedValue(): AssertableExaminedValueInterface
    {
        return $this->examinedValue;
    }
}
