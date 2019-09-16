<?php

namespace webignition\BasilModel\Value;

class DomIdentifierReference extends AbstractReferenceValue implements
    ReferenceValueInterface,
    DomIdentifierReferenceInterface
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
