<?php

namespace webignition\BasilModel\Value;

use webignition\BasilModel\Identifier\PageObjectIdentifierInterface;

interface PageObjectValueInterface extends ValueInterface
{
    public function getIdentifier(): PageObjectIdentifierInterface;
}
