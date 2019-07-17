<?php

namespace webignition\BasilModel;

use webignition\BasilModel\Value\ValueInterface;

trait ValueContainerTrait
{
    private $value;

    public function getValue(): ?ValueInterface
    {
        return $this->value;
    }
}
