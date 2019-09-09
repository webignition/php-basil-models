<?php

namespace webignition\BasilModel\Identifier;

use webignition\BasilModel\Value\ReferenceValueInterface;
use webignition\BasilModel\Value\ValueInterface;

class ReferenceIdentifier extends AbstractIdentifier implements ReferenceIdentifierInterface
{
    private $value;

    public function __construct(string $type, ReferenceValueInterface $value)
    {
        parent::__construct($type);

        $this->value = $value;
    }

    public function getValue(): ValueInterface
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->getValue();
    }
}
