<?php

namespace webignition\BasilModel\Value;

abstract class AbstractValue implements ValueInterface
{
    private $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
