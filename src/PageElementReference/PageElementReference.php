<?php

namespace webignition\BasilModel\PageElementReference;

class PageElementReference implements PageElementReferenceInterface
{
    private const PART_DELIMITER = '.';
    private const EXPECTED_PART_COUNT = 3;
    private const EXPECTED_ELEMENTS_PART = 'elements';

    private const IMPORT_NAME_INDEX = 0;
    private const ELEMENTS_PART_INDEX = 1;
    private const ELEMENT_NAME_INDEX = 2;

    private $importName = '';
    private $elementName = '';
    private $isValid = false;
    private $reference  = '';

    public function __construct(string $reference)
    {
        $reference = trim($reference);
        $this->reference = $reference;

        $referenceParts = explode(self::PART_DELIMITER, $reference);

        $hasExpectedPartCount = self::EXPECTED_PART_COUNT === count($referenceParts);

        if ($hasExpectedPartCount && self::EXPECTED_ELEMENTS_PART === $referenceParts[self::ELEMENTS_PART_INDEX]) {
            $this->importName = $referenceParts[self::IMPORT_NAME_INDEX];
            $this->elementName = $referenceParts[self::ELEMENT_NAME_INDEX];
            $this->isValid = true;
        }
    }

    public function getImportName(): string
    {
        return $this->importName;
    }

    public function getElementName(): string
    {
        return $this->elementName;
    }

    public function isValid(): bool
    {
        return $this->isValid;
    }

    public function __toString(): string
    {
        return $this->reference;
    }
}
