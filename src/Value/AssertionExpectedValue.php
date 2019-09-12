<?php

namespace webignition\BasilModel\Value;

use webignition\BasilModel\Exception\InvalidAssertionExpectedValueException;

class AssertionExpectedValue extends WrappedValue implements AssertionExpectedValueInterface
{
    /**
     * @return AttributeValueInterface|BrowserProperty|DataParameter|ElementValueInterface|EnvironmentValueInterface|LiteralValueInterface|PageProperty|PageElementReference|ReferenceValueInterface
     *
     * @throws InvalidAssertionExpectedValueException
     */
    public function getExpectedValue()
    {
        $value = $this->getWrappedValue();

        if ($value instanceof AttributeValueInterface ||
            $value instanceof BrowserProperty ||
            $value instanceof DataParameter ||
            $value instanceof ElementValueInterface ||
            $value instanceof EnvironmentValueInterface ||
            $value instanceof LiteralValueInterface ||
            $value instanceof PageProperty ||
            $value instanceof PageElementReference ||
            $value instanceof ReferenceValueInterface
        ) {
            return $value;
        }

        throw new InvalidAssertionExpectedValueException($value);
    }
}
