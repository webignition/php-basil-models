<?php

namespace webignition\BasilModel\Value;

use webignition\BasilModel\Exception\InvalidAssertionExaminedValueException;

class AssertionExaminedValue extends WrappedValue implements AssertionExaminedValueInterface
{
    /**
     * @return AttributeValueInterface|BrowserProperty|DataParameter|ElementValueInterface|EnvironmentValueInterface|PageProperty|PageElementReference|ReferenceValueInterface
     *
     * @throws InvalidAssertionExaminedValueException
     */
    public function getExaminedValue()
    {
        $value = $this->getWrappedValue();

        if ($value instanceof AttributeValueInterface ||
            $value instanceof BrowserProperty ||
            $value instanceof DataParameter ||
            $value instanceof ElementValueInterface ||
            $value instanceof EnvironmentValueInterface ||
            $value instanceof PageProperty ||
            $value instanceof PageElementReference ||
            $value instanceof ReferenceValueInterface
        ) {
            return $value;
        }

        throw new InvalidAssertionExaminedValueException($value);
    }
}
