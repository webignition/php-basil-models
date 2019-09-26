<?php

namespace webignition\BasilModel\Action;

use webignition\BasilModel\Value\ExpectableValueInterface;

interface InputActionInterface extends InteractionActionInterface
{
    public function getValue(): ExpectableValueInterface;
    public function withValue(ExpectableValueInterface $value): InputActionInterface;
}
