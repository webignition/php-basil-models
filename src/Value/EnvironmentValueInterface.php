<?php

namespace webignition\BasilModel\Value;

interface EnvironmentValueInterface extends ObjectValueInterface
{
    public function getDefault(): ?string;
}
