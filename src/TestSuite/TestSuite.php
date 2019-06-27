<?php

namespace webignition\BasilModel\TestSuite;

use webignition\BasilModel\Test\TestInterface;

class TestSuite implements TestSuiteInterface
{
    /**
     * @var TestInterface[]
     */
    private $tests = [];

    /**
     * @param TestInterface[] $tests
     */
    public function __construct(array $tests)
    {
        foreach ($tests as $test) {
            if ($test instanceof TestInterface) {
                $this->tests[] = $test;
            }
        }
    }

    /**
     * @return TestInterface[]
     */
    public function getTests(): array
    {
        return $this->tests;
    }
}
