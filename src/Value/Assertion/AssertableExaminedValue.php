<?php

namespace webignition\BasilModel\Value\Assertion;

use webignition\BasilModel\Exception\InvalidAssertableExaminedValueException;
use webignition\BasilModel\Value\AttributeValueInterface;
use webignition\BasilModel\Value\ElementValueInterface;
use webignition\BasilModel\Value\ObjectValueInterface;
use webignition\BasilModel\Value\WrappedValue;

class AssertableExaminedValue extends WrappedValue implements AssertableExaminedValueInterface
{
    /**
     * @return AttributeValueInterface|ElementValueInterface|ObjectValueInterface
     *
     * @throws InvalidAssertableExaminedValueException
     */
    public function getExaminedValue()
    {
        $value = $this->getWrappedValue();

        if ($value instanceof AttributeValueInterface ||
            $value instanceof ElementValueInterface ||
            $value instanceof ObjectValueInterface
        ) {
            return $value;
        }

        throw new InvalidAssertableExaminedValueException($value);
    }
}
