<?php

namespace webignition\BasilModel\Action;

use webignition\BasilModel\Value\ValueInterface;

interface InputActionInterface extends InteractionActionInterface
{
    public function getValue(): ?ValueInterface;
}
