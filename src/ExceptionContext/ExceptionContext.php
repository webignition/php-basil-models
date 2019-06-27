<?php

namespace webignition\BasilModel\ExceptionContext;

class ExceptionContext implements ExceptionContextInterface
{
    private $testName;
    private $stepName;
    private $content;

    public function __construct(array $values = [])
    {
        $this->apply($values);
    }

    public function getTestName(): ?string
    {
        return $this->testName;
    }

    public function getStepName(): ?string
    {
        return $this->stepName;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function apply(array $values)
    {
        $testName = $values[self::KEY_TEST_NAME] ?? null;
        $stepName = $values[self::KEY_STEP_NAME] ?? null;
        $content = $values[self::KEY_CONTENT] ?? null;

        if ($testName) {
            $this->testName = $testName;
        }

        if ($stepName) {
            $this->stepName = $stepName;
        }

        if ($content) {
            $this->content = $content;
        }
    }
}
