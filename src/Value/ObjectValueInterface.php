<?php

namespace webignition\BasilModel\Value;

interface ObjectValueInterface extends ValueInterface
{
    public function getObjectName(): string;
    public function getObjectProperty(): string;
}
