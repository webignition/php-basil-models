<?php

namespace webignition\BasilModel\Value;

interface AssertionExaminedValueInterface extends ValueInterface
{
    /**
     * @return AttributeValueInterface|BrowserProperty|ElementValueInterface|EnvironmentValueInterface|PageElementReference|ReferenceValueInterface
     */
    public function getExaminedValue();
}
