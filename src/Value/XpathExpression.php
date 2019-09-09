<?php

namespace webignition\BasilModel\Value;

class XpathExpression extends AbstractElementExpression implements ElementExpressionInterface
{
    public function getType(): string
    {
        return ValueTypes::XPATH_EXPRESSION;
    }
}
