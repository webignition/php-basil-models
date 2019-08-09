<?php

namespace webignition\BasilModel\Value;

use webignition\BasilModel\Identifier\ElementIdentifierInterface;

interface ElementValueInterface extends ValueInterface
{
    public function getIdentifier(): ElementIdentifierInterface;
}
