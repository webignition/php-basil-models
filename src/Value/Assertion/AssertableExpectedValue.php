<?php

namespace webignition\BasilModel\Value\Assertion;

use webignition\BasilModel\Exception\InvalidAssertableExpectedValueException;
use webignition\BasilModel\Value\AttributeValueInterface;
use webignition\BasilModel\Value\BrowserProperty;
use webignition\BasilModel\Value\ElementValueInterface;
use webignition\BasilModel\Value\EnvironmentValueInterface;
use webignition\BasilModel\Value\LiteralValueInterface;
use webignition\BasilModel\Value\PageProperty;
use webignition\BasilModel\Value\WrappedValue;

class AssertableExpectedValue extends WrappedValue implements AssertableExpectedValueInterface
{
    /**
     * @return AttributeValueInterface|BrowserProperty|ElementValueInterface|EnvironmentValueInterface|LiteralValueInterface|PageProperty
     *
     * @throws InvalidAssertableExpectedValueException
     */
    public function getExpectedValue()
    {
        $value = $this->getWrappedValue();

        if ($value instanceof AttributeValueInterface ||
            $value instanceof BrowserProperty ||
            $value instanceof ElementValueInterface ||
            $value instanceof EnvironmentValueInterface ||
            $value instanceof LiteralValueInterface ||
            $value instanceof PageProperty
        ) {
            return $value;
        }

        throw new InvalidAssertableExpectedValueException($value);
    }
}
