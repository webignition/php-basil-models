<?php

namespace webignition\BasilModel;

use webignition\BasilModel\Value\ValueInterface;

interface ValueContainerInterface
{
    public function getValue(): ?ValueInterface;
}
