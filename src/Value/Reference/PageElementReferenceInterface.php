<?php

namespace webignition\BasilModel\Value\Reference;

interface PageElementReferenceInterface extends ReferenceValueInterface
{
    public function getImportName(): string;
}
