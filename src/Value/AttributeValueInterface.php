<?php

namespace webignition\BasilModel\Value;

use webignition\BasilModel\Identifier\PageObjectIdentifierInterface;

interface AttributeValueInterface extends ValueInterface
{
    public function getIdentifier(): PageObjectIdentifierInterface;
}
