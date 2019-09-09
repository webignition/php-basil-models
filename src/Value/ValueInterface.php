<?php

namespace webignition\BasilModel\Value;

interface ValueInterface
{
    public function isEmpty(): bool;
    public function isActionable(): bool;
    public function __toString(): string;
}
