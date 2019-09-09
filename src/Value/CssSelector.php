<?php

namespace webignition\BasilModel\Value;

class CssSelector extends AbstractElementExpression implements ElementExpressionInterface
{
    public function getType(): string
    {
        return ValueTypes::CSS_SELECTOR;
    }
}
