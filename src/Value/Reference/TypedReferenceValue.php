<?php

namespace webignition\BasilModel\Value\Reference;

class TypedReferenceValue extends AbstractReferenceValue implements TypedReferenceValueInterface
{
    private $type;

    public function __construct(string $type, string $reference, string $property, string $default = '')
    {
        parent::__construct($reference, $property, $default);

        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function isActionable(): bool
    {
        return in_array($this->type, ReferenceValueType::ACTIONABLE);
    }
}
