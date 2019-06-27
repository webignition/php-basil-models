<?php

namespace webignition\BasilModel\PageElementReference;

interface PageElementReferenceInterface
{
    public function getImportName(): string;
    public function getElementName(): string;
    public function isValid(): bool;
    public function __toString(): string;
}
