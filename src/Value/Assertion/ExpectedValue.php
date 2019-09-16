<?php

namespace webignition\BasilModel\Value\Assertion;

use webignition\BasilModel\Exception\InvalidAssertionExpectedValueException;
use webignition\BasilModel\Value\LiteralValueInterface;
use webignition\BasilModel\Value\ObjectValueInterface;
use webignition\BasilModel\Value\PageElementReference;
use webignition\BasilModel\Value\PageObjectValueInterface;
use webignition\BasilModel\Value\ReferenceValueInterface;
use webignition\BasilModel\Value\WrappedValue;

class ExpectedValue extends WrappedValue implements ExpectedValueInterface
{
    /**
     * @return LiteralValueInterface|ObjectValueInterface|PageElementReference|PageObjectValueInterface|ReferenceValueInterface
     *
     * @throws InvalidAssertionExpectedValueException
     */
    public function getExpectedValue()
    {
        $value = $this->getWrappedValue();

        if ($value instanceof LiteralValueInterface ||
            $value instanceof ObjectValueInterface ||
            $value instanceof PageElementReference ||
            $value instanceof PageObjectValueInterface ||
            $value instanceof ReferenceValueInterface
        ) {
            return $value;
        }

        throw new InvalidAssertionExpectedValueException($value);
    }
}
