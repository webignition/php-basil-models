<?php

namespace webignition\BasilModel\Value\Reference;

class PageElementReference extends AbstractReferenceValue implements PageElementReferenceInterface
{
    private $importName;

    public function __construct(
        string $reference,
        string $importName,
        string $property,
        string $default = ''
    ) {
        parent::__construct($reference, $property, $default);

        $this->importName = $importName;
    }

    public function getImportName(): string
    {
        return $this->importName;
    }

    public function isActionable(): bool
    {
        return false;
    }
}
