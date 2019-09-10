<?php

namespace webignition\BasilModel\Value;

interface AssertionExpectedValueInterface extends ValueInterface
{
    /**
     * @return AttributeValueInterface|BrowserProperty|ElementValueInterface|EnvironmentValueInterface|LiteralValueInterface|PageElementReference|ReferenceValueInterface
     */
    public function getExpectedValue();
}
