<?php

namespace webignition\BasilModel\Value;

interface ValueInterface
{
    public function getType(): string;
    public function getValue(): string;
    public function __toString(): string;
}
