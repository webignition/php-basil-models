<?php

namespace webignition\BasilModel\Value;

abstract class AbstractElementExpression implements ElementExpressionInterface
{
    private $expression;

    public function __construct(string $expression)
    {
        $this->expression = $expression;
    }

    public function getExpression(): string
    {
        return $this->expression;
    }

    public function isEmpty(): bool
    {
        return '' === $this->expression;
    }

    public function isActionable(): bool
    {
        return true;
    }

    public function __toString(): string
    {
        return '"' . $this->expression . '"';
    }
}
