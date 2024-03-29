<?php

declare(strict_types=1);

namespace webignition\BasilModel\Test;

class ImportCollection implements ImportCollectionInterface
{
    private $importPaths = [];

    public function __construct(array $importPaths)
    {
        foreach ($importPaths as $importName => $importPath) {
            if (is_string($importPath)) {
                $this->importPaths[$importName] = $importPath;
            }
        }
    }


    public function getImportPath(string $name): ?string
    {
        return $this->importPaths[$name] ?? null;
    }
}
