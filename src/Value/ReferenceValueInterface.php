<?php

declare(strict_types=1);

namespace webignition\BasilModel\Value;

interface ReferenceValueInterface extends ValueInterface
{
    public function getReference(): string;
    public function getProperty(): string;
}
