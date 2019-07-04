<?php

namespace webignition\BasilModel\Identifier;

use webignition\BasilModel\Value\ValueInterface;

class ObjectIdentifier extends Identifier
{
    private $objectName;
    private $objectProperty;

    public function __construct(string $type, ValueInterface $value, string $objectName, string $objectProperty)
    {
        parent::__construct($type, $value, null, null);

        $this->objectName = $objectName;
        $this->objectProperty = $objectProperty;
    }

    public function getObjectName(): string
    {
        return $this->objectName;
    }

    public function getObjectProperty(): string
    {
        return $this->objectProperty;
    }
}
