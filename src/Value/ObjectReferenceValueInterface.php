<?php

declare(strict_types=1);

namespace webignition\BasilModel\Value;

interface ObjectReferenceValueInterface extends ReferenceValueInterface
{
    public function getObject(): string;
}
