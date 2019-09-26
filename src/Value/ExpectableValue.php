<?php

namespace webignition\BasilModel\Value;

use webignition\BasilModel\Exception\InvalidAssertionExpectedValueException;

class ExpectableValue extends WrappedValue implements ExpectableValueInterface
{
    /**
     * @return LiteralValueInterface|ObjectValueInterface|PageElementReference|DomIdentifierValueInterface|ReferenceValueInterface
     *
     * @throws InvalidAssertionExpectedValueException
     */
    public function getExpectedValue()
    {
        $value = $this->getWrappedValue();

        if ($value instanceof LiteralValueInterface ||
            $value instanceof ObjectValueInterface ||
            $value instanceof PageElementReference ||
            $value instanceof DomIdentifierValueInterface ||
            $value instanceof ReferenceValueInterface
        ) {
            return $value;
        }

        throw new InvalidAssertionExpectedValueException($value);
    }
}
