<?php

namespace webignition\BasilModel\Value;

class PageElementReference extends AbstractReferenceValue implements ObjectReferenceValueInterface
{
    public $object = '';

    public function __construct(string $reference, string $object, string $property)
    {
        parent::__construct($reference, $property);

        $this->object = $object;
    }

    public function getObject(): string
    {
        return $this->object;
    }
}
