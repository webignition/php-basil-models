<?php

namespace webignition\BasilModel\Step;

class PendingImportResolutionStep implements StepInterface, PendingImportResolutionStepInterface
{
    private $step;

    /**
     * @var string
     */
    private $importName;

    /**
     * @var string
     */
    private $dataProviderImportName;

    public function __construct(StepInterface $step, string $importName, string $dataProviderImportName)
    {
        $this->step = $step;
        $this->importName = $importName;
        $this->dataProviderImportName = $dataProviderImportName;
    }

    public function getStep(): StepInterface
    {
        return $this->step;
    }

    public function requiresResolution(): bool
    {
        return '' !== $this->importName || '' != $this->dataProviderImportName;
    }

    public function getImportName(): string
    {
        return $this->importName;
    }

    public function getDataProviderImportName(): string
    {
        return $this->dataProviderImportName;
    }

    public function getActions(): array
    {
        return $this->step->getActions();
    }

    public function getAssertions(): array
    {
        return $this->step->getAssertions();
    }

    public function getDataSets(): array
    {
        return $this->step->getDataSets();
    }

    public function getElementIdentifiers(): array
    {
        return $this->step->getElementIdentifiers();
    }

    public function withDataSets(array $dataSets): StepInterface
    {
        $this->step = $this->step->withDataSets($dataSets);

        return $this;
    }

    public function withElementIdentifiers(array $elementIdentifiers): StepInterface
    {
        $this->step = $this->step->withElementIdentifiers($elementIdentifiers);

        return $this;
    }

    public function prependActionsFrom(StepInterface $step): StepInterface
    {
        $this->step = $this->step->prependActionsFrom($step);

        return $this;
    }

    public function prependAssertionsFrom(StepInterface $step): StepInterface
    {
        $this->step = $this->step->prependAssertionsFrom($step);

        return $this;
    }

    public function withActions(array $actions): StepInterface
    {
        $this->step = $this->step->withActions($actions);

        return $this;
    }

    public function withAssertions(array $assertions): StepInterface
    {
        $this->step = $this->step->withAssertions($assertions);

        return $this;
    }
}
