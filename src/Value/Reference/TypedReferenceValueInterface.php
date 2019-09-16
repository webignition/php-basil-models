<?php

namespace webignition\BasilModel\Value\Reference;

use webignition\BasilModel\Value\ValueInterface;

interface TypedReferenceValueInterface extends ReferenceValueInterface
{
    public function getType(): string;
}
