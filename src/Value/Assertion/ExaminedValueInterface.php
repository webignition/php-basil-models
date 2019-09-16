<?php

namespace webignition\BasilModel\Value\Assertion;

use webignition\BasilModel\Exception\InvalidAssertionExaminedValueException;
use webignition\BasilModel\Value\AttributeValueInterface;
use webignition\BasilModel\Value\ElementValueInterface;
use webignition\BasilModel\Value\ObjectValueInterface;
use webignition\BasilModel\Value\PageElementReference;
use webignition\BasilModel\Value\ReferenceValueInterface;
use webignition\BasilModel\Value\ValueInterface;
use webignition\BasilModel\Value\WrappedValueInterface;

interface ExaminedValueInterface extends ValueInterface, WrappedValueInterface
{
    /**
     * @return AttributeValueInterface|ElementValueInterface|ObjectValueInterface|PageElementReference|ReferenceValueInterface
     *
     * @throws InvalidAssertionExaminedValueException
     */
    public function getExaminedValue();
}
