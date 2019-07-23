<?php

namespace webignition\BasilModel\Value;

interface ObjectValueInterface extends ValueInterface
{
    public function getReference(): string;
    public function getObjectName(): string;
    public function getObjectProperty(): string;
}
