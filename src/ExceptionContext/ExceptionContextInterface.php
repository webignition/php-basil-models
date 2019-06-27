<?php

namespace webignition\BasilModel\ExceptionContext;

interface ExceptionContextInterface
{
    const KEY_TEST_NAME = 'test-name';
    const KEY_STEP_NAME = 'step-name';
    const KEY_CONTENT  = 'content';

    public function getTestName(): ?string;
    public function getStepName(): ?string;
    public function getContent(): ?string;
    public function apply(array $values);
}
