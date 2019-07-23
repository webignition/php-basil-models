<?php

namespace webignition\BasilModel\Value;

use webignition\BasilModel\Identifier\IdentifierInterface;

interface ElementValueInterface extends ValueInterface
{
    public function getIdentifier(): IdentifierInterface;
}
