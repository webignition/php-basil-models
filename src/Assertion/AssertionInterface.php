<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\StatementInterface;

interface AssertionInterface extends StatementInterface
{
    public function getComparison(): string;
}
