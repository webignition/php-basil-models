<?php

namespace webignition\BasilModel\Value;

interface AssertionExaminedValueInterface extends ValueInterface, WrappedValueInterface
{
    /**
     * @return AttributeValueInterface|BrowserProperty|DataParameter|ElementValueInterface|EnvironmentValueInterface|PageProperty|PageElementReference|ReferenceValueInterface
     */
    public function getExaminedValue();
}
