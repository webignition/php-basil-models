<?php

namespace webignition\BasilModel\Value\Assertion;

use webignition\BasilModel\Exception\InvalidAssertionExaminedValueException;
use webignition\BasilModel\Value\AttributeValueInterface;
use webignition\BasilModel\Value\BrowserProperty;
use webignition\BasilModel\Value\DataParameter;
use webignition\BasilModel\Value\ElementValueInterface;
use webignition\BasilModel\Value\EnvironmentValueInterface;
use webignition\BasilModel\Value\PageElementReference;
use webignition\BasilModel\Value\PageProperty;
use webignition\BasilModel\Value\ReferenceValueInterface;
use webignition\BasilModel\Value\WrappedValue;

class ExaminedValue extends WrappedValue implements ExaminedValueInterface
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
