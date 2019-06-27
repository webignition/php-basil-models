<?php

namespace webignition\BasilModel\Test;

interface ImportCollectionInterface
{
    public function getImportPath(string $name): ?string;
}
