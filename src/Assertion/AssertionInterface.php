<?php

namespace webignition\BasilModel\Assertion;

interface AssertionInterface
{
    public function getAssertionString(): string;
    public function getComparison(): string;
    public function getSource(): string;
}
