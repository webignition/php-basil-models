<?php

namespace webignition\BasilModel\Step;

class PendingImportResolutionStep extends Step implements StepInterface, PendingImportResolutionStepInterface
{
    /**
     * @var string
     */
    private $importName;

    /**
     * @var string
     */
    private $dataProviderImportName;

    public function __construct(array $actions, array $assertions, string $importName, string $dataProviderImportName)
    {
        parent::__construct($actions, $assertions);

        $this->importName = $importName;
        $this->dataProviderImportName = $dataProviderImportName;
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
}
