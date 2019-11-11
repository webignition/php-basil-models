<?php

declare(strict_types=1);

namespace webignition\BasilModel\Test;

use webignition\BasilModel\Step\StepInterface;

interface TestInterface
{
    public function getName(): string;
    public function getConfiguration(): ConfigurationInterface;

    /**
     * @return StepInterface[]
     */
    public function getSteps(): array;
}
