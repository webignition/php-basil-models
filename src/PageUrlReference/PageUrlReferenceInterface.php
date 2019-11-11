<?php

declare(strict_types=1);

namespace webignition\BasilModel\PageUrlReference;

interface PageUrlReferenceInterface
{
    public function getImportName(): string;
    public function isValid(): bool;
    public function __toString(): string;
}
