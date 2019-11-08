<?php

declare(strict_types=1);

namespace webignition\BasilModel\Step;

interface PendingImportResolutionStepInterface extends StepInterface
{
    public function getImportName(): string;
    public function getDataProviderImportName(): string;
    public function requiresResolution(): bool;
    public function getStep(): StepInterface;
    public function clearImportName(): PendingImportResolutionStepInterface;
    public function clearDataProviderImportName(): PendingImportResolutionStepInterface;
}
