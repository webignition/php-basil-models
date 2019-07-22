<?php

namespace webignition\BasilModel\Value;

class EnvironmentValue extends ObjectValue implements EnvironmentValueInterface
{
    private $default;

    public function __construct(
        string $value,
        string $objectProperty,
        ?string $default = null
    ) {
        parent::__construct(ValueTypes::ENVIRONMENT_PARAMETER, $value, ObjectNames::ENVIRONMENT, $objectProperty);

        $this->default = $default;
    }

    public function getDefault(): ?string
    {
        return $this->default;
    }

    public function __toString(): string
    {
        $string = parent::__toString();

        if (null !== $this->default) {
            $string .= '|"' . str_replace('"', '\"', $this->default) . '"';
        }

        return $string;
    }
}
