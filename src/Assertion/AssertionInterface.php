<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\StatementInterface;

interface AssertionInterface extends StatementInterface
{
    public function getAssertionString(): string;
    public function getComparison(): string;
}
