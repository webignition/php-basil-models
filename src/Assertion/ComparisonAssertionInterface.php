<?php

declare(strict_types=1);

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\Value\ValueInterface;

interface ComparisonAssertionInterface extends ExaminationAssertionInterface
{
    public function getExpectedValue(): ValueInterface;
    public function withExpectedValue(ValueInterface $value): ComparisonAssertionInterface;
}
