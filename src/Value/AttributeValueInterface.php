<?php

namespace webignition\BasilModel\Value;

use webignition\BasilModel\Identifier\AttributeIdentifierInterface;

interface AttributeValueInterface extends ValueInterface
{
    public function getIdentifier(): AttributeIdentifierInterface;
}
