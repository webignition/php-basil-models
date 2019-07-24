<?php

namespace webignition\BasilModel\Identifier;

interface IdentifierInterface
{
    public function getType(): string;
    public function __toString(): string;
}
