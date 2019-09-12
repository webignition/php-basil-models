<?php

namespace webignition\BasilModel\Value;

interface WrappedValueInterface extends ValueInterface
{
    public function getWrappedValue(): ValueInterface;
}
