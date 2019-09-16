<?php

namespace webignition\BasilModel\Value\Reference;

use webignition\BasilModel\Value\ValueInterface;

interface ReferenceValueInterface extends ValueInterface
{
    public function getDefault(): string;
    public function getProperty(): string;
    public function getReference(): string;
}
