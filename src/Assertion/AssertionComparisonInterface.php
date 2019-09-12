<?php

namespace webignition\BasilModel\Assertion;

interface AssertionComparisonInterface
{
    public function getValue(): string;
    public function __toString(): string;
}
