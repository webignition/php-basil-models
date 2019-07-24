<?php

namespace webignition\BasilModel\Identifier;

use webignition\BasilModel\Value\ValueInterface;

interface ReferenceIdentifierInterface extends IdentifierInterface
{
    public function getValue(): ValueInterface;
}
