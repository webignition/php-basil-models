<?php

namespace webignition\BasilModel\Value;

use webignition\BasilModel\Identifier\PageObjectIdentifierInterface;

interface ElementValueInterface extends ValueInterface
{
    public function getIdentifier(): PageObjectIdentifierInterface;
}
