<?php

namespace webignition\BasilModel\TestSuite;

use webignition\BasilModel\Test\TestInterface;

interface TestSuiteInterface
{
    /**
     * @return TestInterface[]
     */
    public function getTests(): array;
}
