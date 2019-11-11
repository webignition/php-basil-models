<?php

declare(strict_types=1);

namespace webignition\BasilModel\Test;

interface ImportCollectionInterface
{
    public function getImportPath(string $name): ?string;
}
