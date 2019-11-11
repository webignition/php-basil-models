<?php

declare(strict_types=1);

namespace webignition\BasilModel\Step;

use webignition\BasilModel\DataSet\DataSetCollectionInterface;
use webignition\BasilModel\Identifier\IdentifierCollectionInterface;

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

    public function getDataSetCollection(): DataSetCollectionInterface
    {
        return $this->step->getDataSetCollection();
    }

    public function getIdentifierCollection(): IdentifierCollectionInterface
    {
        return $this->step->getIdentifierCollection();
    }

    public function withDataSetCollection(DataSetCollectionInterface $dataSetCollection): StepInterface
    {
        $this->step = $this->step->withDataSetCollection($dataSetCollection);

        return $this;
    }

    public function withIdentifierCollection(IdentifierCollectionInterface $identifierCollection): StepInterface
    {
        $this->step = $this->step->withIdentifierCollection($identifierCollection);

        return $this;
    }

    public function withPrependedActions(array $actions): StepInterface
    {
        $this->step = $this->step->withPrependedActions($actions);

        return $this;
    }

    public function withPrependedAssertions(array $assertions): StepInterface
    {
        $this->step = $this->step->withPrependedAssertions($assertions);

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

    public function clearImportName(): PendingImportResolutionStepInterface
    {
        $new = clone $this;
        $new->importName = '';

        return $new;
    }

    public function clearDataProviderImportName(): PendingImportResolutionStepInterface
    {
        $new = clone $this;
        $new->dataProviderImportName = '';

        return $new;
    }
}
