<?php

declare(strict_types=1);

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\StatementInterface;

interface AssertionInterface extends StatementInterface
{
    public function getComparison(): string;
}
