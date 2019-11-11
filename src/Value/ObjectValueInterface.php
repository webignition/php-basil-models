<?php

declare(strict_types=1);

namespace webignition\BasilModel\Value;

interface ObjectValueInterface extends ValueInterface
{
    public function getType(): string;
    public function getReference(): string;
    public function getProperty(): string;
    public function getDefault(): string;
}
