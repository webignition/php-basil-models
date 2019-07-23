<?php

namespace webignition\BasilModel\Value;

interface LiteralValueInterface extends ValueInterface
{
    public function getValue(): string;
}
