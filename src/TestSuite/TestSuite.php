<?php

namespace webignition\BasilModel\TestSuite;

use webignition\BasilModel\Test\TestInterface;

class TestSuite implements TestSuiteInterface
{
    /**
     * @var string
     */
    private $name = '';

    /**
     * @var TestInterface[]
     */
    private $tests = [];

    /**
     * @param string $name
     * @param TestInterface[] $tests
     */
    public function __construct(string $name, array $tests)
    {
        $this->name = $name;

        foreach ($tests as $test) {
            if ($test instanceof TestInterface) {
                $this->tests[] = $test;
            }
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return TestInterface[]
     */
    public function getTests(): array
    {
        return $this->tests;
    }
}
