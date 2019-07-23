<?php

namespace webignition\BasilModel\Value;

interface ValueInterface
{
    public function getType(): string;
    public function isEmpty(): bool;
    public function isActionable(): bool;
    public function __toString(): string;
}
