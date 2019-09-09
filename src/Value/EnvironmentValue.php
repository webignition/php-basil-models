<?php

namespace webignition\BasilModel\Value;

class EnvironmentValue extends AbstractObjectValue implements EnvironmentValueInterface
{
    private $default;

    public function __construct(
        string $reference,
        string $objectProperty,
        ?string $default = null
    ) {
        parent::__construct($reference, $objectProperty);

        $this->default = $default;
    }

    public function getDefault(): ?string
    {
        return $this->default;
    }

    public function isActionable(): bool
    {
        return true;
    }

    public function __toString(): string
    {
        return $this->getReference();
    }
}
