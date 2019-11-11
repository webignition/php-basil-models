<?php

declare(strict_types=1);

namespace webignition\BasilModel\Value;

interface LiteralValueInterface extends ValueInterface
{
    public function getValue(): string;
}
