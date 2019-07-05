<?php

namespace webignition\BasilModel\Step;

interface PendingImportResolutionStepInterface extends StepInterface
{
    public function getImportName(): string;
    public function getDataProviderImportName(): string;
    public function requiresResolution(): bool;
}
