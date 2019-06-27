<?php

namespace webignition\BasilModel\Test;

use webignition\BasilModel\Step\StepInterface;

class Test implements TestInterface
{
    private $name;
    private $configuration;
    private $steps;

    public function __construct(string $name, ConfigurationInterface $configuration, array $steps)
    {
        $this->name = $name;
        $this->configuration = $configuration;

        foreach ($steps as $stepName => $step) {
            if ($step instanceof StepInterface) {
                $this->steps[$stepName] = $step;
            }
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getConfiguration(): ConfigurationInterface
    {
        return $this->configuration;
    }

    /**
     * @return StepInterface[]
     */
    public function getSteps(): array
    {
        return $this->steps;
    }
}
