<?php

namespace webignition\BasilModel\Value\Assertion;

use webignition\BasilModel\Exception\InvalidAssertionExpectedValueException;
use webignition\BasilModel\Value\AttributeValueInterface;
use webignition\BasilModel\Value\ElementValueInterface;
use webignition\BasilModel\Value\LiteralValueInterface;
use webignition\BasilModel\Value\ObjectValueInterface;
use webignition\BasilModel\Value\PageElementReference;
use webignition\BasilModel\Value\ReferenceValueInterface;
use webignition\BasilModel\Value\WrappedValue;

class ExpectedValue extends WrappedValue implements ExpectedValueInterface
{
    /**
     * @return AttributeValueInterface|ElementValueInterface|LiteralValueInterface|ObjectValueInterface|PageElementReference|ReferenceValueInterface
     *
     * @throws InvalidAssertionExpectedValueException
     */
    public function getExpectedValue()
    {
        $value = $this->getWrappedValue();

        if ($value instanceof AttributeValueInterface ||
            $value instanceof ElementValueInterface ||
            $value instanceof LiteralValueInterface ||
            $value instanceof PageElementReference ||
            $value instanceof ReferenceValueInterface ||
            $value instanceof ObjectValueInterface
        ) {
            return $value;
        }

        throw new InvalidAssertionExpectedValueException($value);
    }
}
