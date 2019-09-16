<?php

namespace webignition\BasilModel\Value\Assertion;

use webignition\BasilModel\Exception\InvalidAssertableExaminedValueException;
use webignition\BasilModel\Value\ObjectValueInterface;
use webignition\BasilModel\Value\DomIdentifierValueInterface;
use webignition\BasilModel\Value\WrappedValue;

class AssertableExaminedValue extends WrappedValue implements AssertableExaminedValueInterface
{
    /**
     * @return ObjectValueInterface|DomIdentifierValueInterface
     *
     * @throws InvalidAssertableExaminedValueException
     */
    public function getExaminedValue()
    {
        $value = $this->getWrappedValue();

        if ($value instanceof ObjectValueInterface || $value instanceof DomIdentifierValueInterface) {
            return $value;
        }

        throw new InvalidAssertableExaminedValueException($value);
    }
}
