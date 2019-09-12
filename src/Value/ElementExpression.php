<?php

namespace webignition\BasilModel\Value;

class ElementExpression implements ElementExpressionInterface
{
    private $expression;
    private $type;

    public function __construct(string $expression, string $type)
    {
        $this->expression = $expression;
        $this->type = $type;
    }

    public function getExpression(): string
    {
        return $this->expression;
    }

    public function getType(): string
    {
        return $this->type;
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
