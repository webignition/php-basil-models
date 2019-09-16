<?php

namespace webignition\BasilModel\Value;

class PageObjectReference extends AbstractReferenceValue implements
    ReferenceValueInterface,
    PageObjectReferenceInterface
{
    private $type;

    public function __construct(string $type, string $reference, string $property)
    {
        parent::__construct($reference, $property);

        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function isActionable(): bool
    {
        return false;
    }
}
