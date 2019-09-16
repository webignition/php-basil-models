<?php

namespace webignition\BasilModel\Value\Assertion;

use webignition\BasilModel\Exception\InvalidAssertionExaminedValueException;
use webignition\BasilModel\Value\AttributeValueInterface;
use webignition\BasilModel\Value\ElementValueInterface;
use webignition\BasilModel\Value\ObjectValueInterface;
use webignition\BasilModel\Value\PageElementReference;
use webignition\BasilModel\Value\ReferenceValueInterface;
use webignition\BasilModel\Value\WrappedValue;

class ExaminedValue extends WrappedValue implements ExaminedValueInterface
{
    /**
     * @return AttributeValueInterface|ElementValueInterface|ObjectValueInterface|PageElementReference|ReferenceValueInterface
     *
     * @throws InvalidAssertionExaminedValueException
     */
    public function getExaminedValue()
    {
        $value = $this->getWrappedValue();

        if ($value instanceof AttributeValueInterface ||
            $value instanceof ElementValueInterface ||
            $value instanceof PageElementReference ||
            $value instanceof ReferenceValueInterface ||
            $value instanceof ObjectValueInterface
        ) {
            return $value;
        }

        throw new InvalidAssertionExaminedValueException($value);
    }
}
