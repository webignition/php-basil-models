<?php

declare(strict_types=1);

namespace webignition\BasilModel\Value;

interface ValueInterface
{
    public function isEmpty(): bool;
    public function isActionable(): bool;
    public function __toString(): string;
}
