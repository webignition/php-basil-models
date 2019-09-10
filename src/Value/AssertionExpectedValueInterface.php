<?php

namespace webignition\BasilModel\Value;

interface AssertionExpectedValueInterface extends ValueInterface
{
    /**
     * @return AttributeValueInterface|BrowserProperty|DataParameter|ElementValueInterface|EnvironmentValueInterface|LiteralValueInterface|PageProperty|PageElementReference|ReferenceValueInterface
     */
    public function getExpectedValue();
}
