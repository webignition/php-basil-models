<?php

namespace webignition\BasilModel\Value;

interface ObjectReferenceValueInterface extends ReferenceValueInterface
{
    public function getObject(): string;
}
