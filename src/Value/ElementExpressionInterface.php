<?php

namespace webignition\BasilModel\Value;

interface ElementExpressionInterface extends ValueInterface
{
    public function getExpression(): string;
}
