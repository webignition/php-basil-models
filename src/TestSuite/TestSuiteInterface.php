<?php

declare(strict_types=1);

namespace webignition\BasilModel\TestSuite;

use webignition\BasilModel\Test\TestInterface;

interface TestSuiteInterface
{
    public function getName(): string;

    /**
     * @return TestInterface[]
     */
    public function getTests(): array;
}
